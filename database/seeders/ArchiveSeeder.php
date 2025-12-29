<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Archive;
use Illuminate\Support\Facades\File;

class ArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('archives.json');
        
        if (!File::exists($jsonPath)) {
            $this->command->error('El archivo archives.json no existe en database/');
            return;
        }

        $jsonData = File::get($jsonPath);
        $archives = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error('Error al decodificar el JSON: ' . json_last_error_msg());
            return;
        }

        $this->command->info('Iniciando la importación de ' . count($archives) . ' archivos...');

        foreach ($archives as $archive) {
            Archive::create([
                'archiveid' => $archive['archiveid'] ?? '',
                'title' => $archive['title'] ?? '',
                'description' => $archive['description'] ?? '',
                'image' => $archive['image'] ?? '',
                'category' => $archive['category'] ?? '',
                'format' => $archive['format'] ?? '',
                'status' => $archive['status'] ?? '',
                'location' => $archive['location'] ?? '',
                'year' => $archive['year'] ?? '',
                'height' => $archive['height'] ?? '',
                'width' => $archive['width'] ?? '',
                'slug' => $archive['slug'] ?? '',
                'length' => $archive['length'] ?? null,
            ]);
        }

        $this->command->info('¡Importación completada! Se importaron ' . count($archives) . ' archivos.');
    }
}
