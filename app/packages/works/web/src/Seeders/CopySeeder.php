<?php

namespace Works\Web\Seeders;


use Illuminate\Database\Seeder;
use Works\Web\Models\Copy;

class CopySeeder extends Seeder
{
    public function run(): void
    {
        Copy::create([
            'web_id' => 1,
            'author_id' => 1,
            'name' => 'Creative Commons License',
            'slug' => 'creative-commons-license',
            'title' => 'Creative Commons Attribution 4.0 International',
            'subtitle' => 'Free to Share and Adapt',
            'text' => 'This work is licensed under a Creative Commons Attribution 4.0 International License.',
            'subtext' => 'You are free to share, adapt, and build upon this work as long as attribution is provided.',
            'copy' => 'copyright',
            'license' => 'Creative Commons',
            'url' => 'https://creativecommons.org/licenses/by/4.0/',
        ]);

        Copy::create([
            'web_id' => 1,
            'author_id' => 1,
            'name' => 'GPL License',
            'slug' => 'gpl-license',
            'title' => 'GNU General Public License v3.0',
            'subtitle' => 'Freedom to Use, Study, Modify, and Share',
            'text' => 'This work is distributed under the terms of the GNU General Public License.',
            'subtext' => 'You are free to use, study, modify, and share this software under the GPL.',
            'copy' => 'copyleft',
            'license' => 'GPL',
            'url' => 'https://www.gnu.org/licenses/gpl-3.0.html',
        ]);
    }
}
