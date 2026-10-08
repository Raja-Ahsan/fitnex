@php
	$selectedSlugs = array_map('strval', (array) ($selected ?? []));
@endphp

@once
<style>
	.tt-picker { border: 1px solid #e3e6ea; border-radius: 8px; padding: 12px; background: #fafbfc; }
	.tt-picker.has-error { border-color: #dd4b39; background: #fff8f7; }
	.tt-picker__bar { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 10px; flex-wrap: wrap; }
	.tt-picker__count { font-size: 12px; color: #6c757d; }
	.tt-picker__count strong { color: #222; }
	.tt-picker__actions button { background: none; border: 0; padding: 0 0 0 12px; font-size: 12px; font-weight: 600; color: #3c8dbc; cursor: pointer; }
	.tt-picker__actions button:hover { text-decoration: underline; }
	.tt-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 8px; }
	.tt-option { position: relative; display: flex !important; align-items: center; gap: 10px; margin: 0 !important; padding: 10px 12px; border: 1px solid #dfe3e8; border-radius: 6px; background: #fff; font-weight: 500 !important; color: #333; cursor: pointer; transition: border-color .15s, background .15s, box-shadow .15s; user-select: none; }
	.tt-option:hover { border-color: #3c8dbc; }
	.tt-option input { position: absolute; opacity: 0; pointer-events: none; }
	.tt-option__box { flex: 0 0 18px; width: 18px; height: 18px; border: 2px solid #c3c9d0; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; background: #fff; transition: all .15s; }
	.tt-option__box::after { content: ''; width: 5px; height: 9px; border: solid #fff; border-width: 0 2px 2px 0; transform: rotate(45deg) scale(0); margin-top: -2px; transition: transform .15s; }
	.tt-option input:checked ~ .tt-option__box { background: #3c8dbc; border-color: #3c8dbc; }
	.tt-option input:checked ~ .tt-option__box::after { transform: rotate(45deg) scale(1); }
	.tt-option input:focus-visible ~ .tt-option__box { box-shadow: 0 0 0 3px rgba(60, 141, 188, .25); }
	.tt-option.is-checked { border-color: #3c8dbc; background: #f0f7fc; }
	.tt-option__label { line-height: 1.3; }
	.tt-picker__error { display: none; margin-top: 8px; font-size: 12px; color: #dd4b39; }
	.tt-picker.has-error .tt-picker__error { display: block; }
</style>
@endonce

<div class="tt-picker {{ $errors->has('trainer_types') ? 'has-error' : '' }}" data-tt-picker>
	<div class="tt-picker__bar">
		<span class="tt-picker__count"><strong data-tt-count>{{ count($selectedSlugs) }}</strong> of {{ $categories->count() }} selected</span>
		<span class="tt-picker__actions">
			<button type="button" data-tt-all>Select all</button>
			<button type="button" data-tt-none>Clear</button>
		</span>
	</div>
	<div class="tt-grid">
		@foreach($categories as $category)
			@php $isChecked = in_array((string) $category->slug, $selectedSlugs, true); @endphp
			<label class="tt-option {{ $isChecked ? 'is-checked' : '' }}">
				<input type="checkbox" name="trainer_types[]" value="{{ $category->slug }}" {{ $isChecked ? 'checked' : '' }}>
				<span class="tt-option__box" aria-hidden="true"></span>
				<span class="tt-option__label">{{ $category->title }}</span>
			</label>
		@endforeach
	</div>
	<div class="tt-picker__error">Please select at least one category.</div>
</div>
@if($errors->has('trainer_types'))
	<span style="color: red">{{ $errors->first('trainer_types') }}</span>
@endif

@once
<script>
	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('[data-tt-picker]').forEach(function (picker) {
			var boxes = picker.querySelectorAll('input[type=checkbox]');
			var count = picker.querySelector('[data-tt-count]');

			function refresh() {
				var n = 0;
				boxes.forEach(function (b) {
					b.closest('.tt-option').classList.toggle('is-checked', b.checked);
					if (b.checked) n++;
				});
				count.textContent = n;
				if (n > 0) picker.classList.remove('has-error');
				return n;
			}

			boxes.forEach(function (b) { b.addEventListener('change', refresh); });
			picker.querySelector('[data-tt-all]').addEventListener('click', function () {
				boxes.forEach(function (b) { b.checked = true; });
				refresh();
			});
			picker.querySelector('[data-tt-none]').addEventListener('click', function () {
				boxes.forEach(function (b) { b.checked = false; });
				refresh();
			});

			var form = picker.closest('form');
			if (form) {
				form.addEventListener('submit', function (e) {
					if (refresh() === 0) {
						e.preventDefault();
						e.stopImmediatePropagation();
						picker.classList.add('has-error');
						picker.scrollIntoView({ behavior: 'smooth', block: 'center' });
					}
				}, true);
			}
		});
	});
</script>
@endonce
