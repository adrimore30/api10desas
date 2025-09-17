<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publication;
use App\Models\Category;
use App\Models\PublicationCategory;

class PublicationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar tabla existente
        PublicationCategory::truncate();

        $publications = Publication::all();
        $categories = Category::all();

        if ($publications->isEmpty() || $categories->isEmpty()) {
            $this->command->error('❌ No hay publicaciones o categorías para crear relaciones');
            return;
        }

        // Crear 20 asignaciones aleatorias
        for ($i = 0; $i < 20; $i++) {
            PublicationCategory::create([
                'publication_id' => $publications->random()->id,
                'category_id' => $categories->random()->id
            ]);
        }

        $this->command->info('✅ 20 asignaciones publicación-categoría creadas!');
    }
}
