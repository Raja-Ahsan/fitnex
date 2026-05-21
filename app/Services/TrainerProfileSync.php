<?php

namespace App\Services;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TrainerProfileSync
{
    public static function resolveTrainer(User $user): Trainer
    {
        $trainer = Trainer::where('created_by', $user->id)->first();

        if ($trainer) {
            return $trainer;
        }

        return Trainer::create([
            'created_by' => $user->id,
            'status' => $user->status == 1 ? 1 : 0,
        ]);
    }

    public static function validationRules(User $user, bool $requireImage = false): array
    {
        $imageRule = ($requireImage ? 'required|' : 'nullable|') . 'image|mimes:jpeg,jpg,png,gif,webp|'.upload_file_rule();

        return [
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:50',
            'password' => 'nullable|min:8|confirmed',
            'image' => $imageRule,
            'description' => 'required|string|max:5000',
            'trainer_types' => 'required|array|min:1',
            'trainer_types.*' => 'required|string',
            'price' => 'required|string|max:50',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'specialization' => 'nullable|array',
            'specialization.*' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:500',
            'twitter' => 'nullable|string|max:500',
            'instagram' => 'nullable|string|max:500',
            'linkedin' => 'nullable|string|max:500',
            'youtube' => 'nullable|string|max:500',
        ];
    }

    public static function syncFromRequest(Request $request, User $user, Trainer $trainer): void
    {
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->designation = $request->designation;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->linkedin = $request->linkedin;
        $user->youtube = $request->youtube;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path('admin/assets/images/UserImage/' . $user->image))) {
                @unlink(public_path('admin/assets/images/UserImage/' . $user->image));
            }

            $imageName = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('admin/assets/images/UserImage'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        $specializations = collect($request->input('specialization', []))
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();

        $trainer->update([
            'trainer_type' => implode(',', $request->trainer_types),
            'delivery_modes' => self::normalizedDeliveryModes($request),
            'description' => $request->description,
            'price' => $request->price,
            'specialization' => $specializations ? json_encode($specializations) : null,
            'city' => $request->city,
            'state' => $request->state,
            'status' => $user->status == 1 ? 1 : 0,
        ]);
    }

    public static function normalizedDeliveryModes(Request $request): ?string
    {
        $modes = [];

        if ($request->boolean('delivery_online')) {
            $modes[] = 'online';
        }

        if ($request->boolean('delivery_in_person')) {
            $modes[] = 'in_person';
        }

        return count($modes) ? implode(',', $modes) : null;
    }

    public static function isProfileComplete(Trainer $trainer): bool
    {
        $attrs = $trainer->getAttributes();

        return !empty($attrs['description'])
            && !empty($attrs['trainer_type'])
            && !empty($attrs['price'])
            && !empty($attrs['city'])
            && !empty($attrs['state'])
            && !empty($attrs['delivery_modes']);
    }
}
