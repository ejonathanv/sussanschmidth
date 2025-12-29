<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exhibition;
use Illuminate\Support\Facades\File;

class ExhibitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = database_path('exhibitions.csv');
        
        if (!File::exists($csvPath)) {
            $this->command->error('El archivo exhibitions.csv no existe en database/');
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
            Exhibition::create([
                'year' => $row[1] ?? '',
                'title' => $row[2] ?? '',
                'subtitle' => $row[3] ?? '',
                'description' => $row[4] ?? '',
                'description_two' => $row[5] ?? '',
                'place' => $row[6] ?? '',
                'location' => $row[7] ?? '',
                'category' => $row[8] ?? '',
            ]);
            $count++;
        }

        fclose($file);
        
        $this->command->info('¡Importación completada! Se importaron ' . $count . ' exhibiciones.');
    }
}
