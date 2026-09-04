<?php

/**
 * Search vocabulary for the public "Find a Wellness Professional" wizard.
 * Goals are matched against existing trainer_type, specialization, and description
 * — this is not a separate goals table.
 */
return [
    'options' => [
        'lose-weight' => [
            'label' => 'Lose Weight',
            'keywords' => ['weight loss', 'weight-loss', 'lose weight', 'weight management', 'fat loss', 'weightloss'],
            'category_slugs' => ['weight-loss-coach'],
        ],
        'build-muscle' => [
            'label' => 'Build Muscle',
            'keywords' => ['build muscle', 'muscle', 'hypertrophy', 'body building', 'bodybuilding', 'body-building'],
            'category_slugs' => ['body-building'],
        ],
        'increase-strength' => [
            'label' => 'Increase Strength',
            'keywords' => ['strength', 'conditioning', 'powerlifting', 'strength building'],
            'category_slugs' => ['strength-and-conditioning-coach'],
        ],
        'improve-fitness' => [
            'label' => 'Improve Fitness',
            'keywords' => ['fitness', 'functional', 'conditioning', 'beginner', 'general conditioning', 'personal training'],
            'category_slugs' => ['personal-training', 'custom-goal-based-plans'],
        ],
        'sports-performance' => [
            'label' => 'Sports Performance',
            'keywords' => ['sports', 'performance', 'athletic', 'athlete'],
            'category_slugs' => ['sports-performance'],
        ],
        'bodybuilding' => [
            'label' => 'Bodybuilding',
            'keywords' => ['bodybuilding', 'body building', 'body-building'],
            'category_slugs' => ['body-building'],
        ],
        'nutrition' => [
            'label' => 'Nutrition',
            'keywords' => ['nutrition', 'diet', 'nutritionist', 'meal'],
            'category_slugs' => ['nutrition-coaching'],
        ],
        'overall-wellness' => [
            'label' => 'Improve Overall Wellness',
            'keywords' => ['wellness', 'health', 'menopause', 'chronic', 'health coach'],
            'category_slugs' => ['custom-goal-based-plans'],
        ],
        'other' => [
            'label' => 'Other',
            'keywords' => [],
        ],
    ],
];
