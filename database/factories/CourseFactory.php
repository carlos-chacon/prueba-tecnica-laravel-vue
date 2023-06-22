<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTime();
        $end = $this->faker->date();
        return [
            'name' => $this->faker->randomElements($this->someCourses(), 1, false),
            'schedule' => $this->faker->randomElements($this->schedules(), 1, true),
            'start_date' => $start,
            'end_date' => $end,
            'number_students' => 0,
        ];
    }


    function someCourses() : array {
        return [
            'Curso de Programación para Principiantes',
            'Fundamentos de Programación con Python',
            'Aprende a Programar en JavaScript',
            'Curso de Desarrollo Web Completo (HTML, CSS, JavaScript)',
            'Desarrollo Web con React.js',
            'Curso de Backend con Node.js y Express',
            'Curso de Desarrollo de Aplicaciones Android con Kotlin',
            'Desarrollo de Aplicaciones iOS con Swift',
            'Introducción al Desarrollo de Aplicaciones Híbridas con React Native',
            'Introducción a la Ciencia de Datos con Python',
            'Análisis de Datos con R',
            'Aprendizaje Automático (Machine Learning) con Python',
            'Introducción a la Seguridad Informática',
            'Hacking Ético y Pruebas de Penetración',
            'Seguridad en Desarrollo Web',
            'Introducción a la Inteligencia Artificial',
            'Aprendizaje Automático con Python y TensorFlow',
            'Procesamiento del Lenguaje Natural (NLP) con Python',
        ];
    }

    function schedules() : array {
        return [
            'Martes a viernes 7:00 am - 9:00 am o Lunes, martes, miércoles y viernes 7:00 am - 9:00 am',
            'Martes a viernes 11:00 am - 1:00 pm',
            'Lunes a jueves 2:00 pm - 4:00 pm',
            'Lunes a jueves 4:00 pm - 6:00 pm',
            'Lunes a jueves 6:00 pm - 8:00 pm',
        ];
    }
}
