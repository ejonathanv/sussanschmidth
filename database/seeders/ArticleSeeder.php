<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Facades\File;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = database_path('articles.csv');
        
        if (!File::exists($csvPath)) {
            $this->command->error('El archivo articles.csv no existe en database/');
            return;
        }

        $file = fopen($csvPath, 'r');
        
        // Leer la primera línea (encabezados)
        $headers = fgetcsv($file);
        
        if (!$headers) {
            $this->command->error('No se pudieron leer los encabezados del CSV');
            fclose($file);
            return;
        }

        $count = 0;
        
        while (($row = fgetcsv($file)) !== false) {
            // Mapear los datos del CSV a los campos del modelo
            Article::create([
                'title' => $row[1] ?? '',
                'description' => $row[2] ?? '',
                'location' => $row[3] ?? '',
                'publication' => $row[4] ?? '',
                'image' => $row[5] ?? '',
                'slug' => $row[6] ?? '',
                'date' => $row[7] ?? '',
            ]);
            $count++;
        }

        fclose($file);
        
        $this->command->info('¡Importación completada! Se importaron ' . $count . ' artículos.');
    }
}
