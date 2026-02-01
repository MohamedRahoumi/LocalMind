<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Response;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        // Question 1
        $q1 = Question::create([
            'user_id' => 2,
            'title' => 'Où trouver un bon médecin généraliste à Rabat?',
            'content' => 'Je viens d\'arriver à Rabat et j\'ai besoin de trouver un médecin généraliste de confiance. Avez-vous des recommandations?',
            'location' => 'Rabat, Maroc',
            'latitude' => 34.0209,
            'longitude' => -6.8416,
            'views' => 45,
        ]);

        Response::create([
            'user_id' => 1,
            'question_id' => $q1->id,
            'content' => 'Je vous recommande le Dr. Bennani sur l\'Avenue Mohammed V. Très professionnel et à l\'écoute.',
        ]);

        Response::create([
            'user_id' => 3,
            'question_id' => $q1->id,
            'content' => 'Il y a aussi une excellente clinique près de la gare, la Clinique Al Farabi.',
        ]);

        // Question 2
        $q2 = Question::create([
            'user_id' => 3,
            'title' => 'Quel est le meilleur quartier pour se loger à Marrakech?',
            'content' => 'Je cherche un appartement à louer. Quel quartier est calme et bien desservi par les transports?',
            'location' => 'Marrakech, Maroc',
            'latitude' => 31.6295,
            'longitude' => -7.9811,
            'views' => 67,
        ]);

        Response::create([
            'user_id' => 2,
            'question_id' => $q2->id,
            'content' => 'Gueliz est un excellent choix. C\'est moderne, calme et proche de tout.',
        ]);

        // Question 3
        Question::create([
            'user_id' => 4,
            'title' => 'Cours d\'arabe pour débutants à Tanger?',
            'content' => 'Je cherche des cours d\'arabe pour débutants. Connaissez-vous des écoles ou des professeurs particuliers?',
            'location' => 'Tanger, Maroc',
            'latitude' => 35.7595,
            'longitude' => -5.8340,
            'views' => 23,
        ]);

        // Question 4
        Question::create([
            'user_id' => 2,
            'title' => 'Où faire du sport à Rabat?',
            'content' => 'Je cherche une salle de sport ou un club de running dans le quartier Agdal.',
            'location' => 'Rabat, Maroc',
            'latitude' => 34.0209,
            'longitude' => -6.8416,
            'views' => 31,
        ]);

        // Question 5
        Question::create([
            'user_id' => 3,
            'title' => 'Meilleurs restaurants traditionnels à Marrakech?',
            'content' => 'Je voudrais faire découvrir la cuisine marocaine à des amis étrangers. Où m\'conseillez-vous d\'aller?',
            'location' => 'Marrakech, Maroc',
            'latitude' => 31.6295,
            'longitude' => -7.9811,
            'views' => 89,
        ]);
    }
}