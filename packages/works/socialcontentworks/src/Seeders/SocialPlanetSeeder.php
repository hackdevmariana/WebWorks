<?php

namespace Works\Socialcontentworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Socialcontentworks\Models\SocialPlanet;

class SocialPlanetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialPlanet::create([
            'name' => 'Matemáticas',
            'slug' => 'matematicas',
            'description' => '',
            'accounts' => [
                "https://www.youtube.com/@Derivando",
                "https://www.youtube.com/@julioprofe",
                "https://www.youtube.com/@unicoos",
                "https://www.youtube.com/@math2me",
                "https://www.youtube.com/@MateFacil",
                "https://www.youtube.com/@ElTraductorDeIngenieria",
                "https://www.youtube.com/@MatematicasProfeAlex",
                "https://x.com/edusadeci",
                "https://x.com/apr_matematicas",
                "https://x.com/scmpm",
                "https://x.com/franprofemates",
                "https://x.com/ClaraGrima",
                "https://x.com/ThalesAlmeria",
                "https://www.instagram.com/eduardosdc/",
                "https://www.instagram.com/profesorademates/",
                "https://www.instagram.com/raizdemate/",
                "https://www.instagram.com/matematicasconm/",
                "https://www.instagram.com/matematicasfacil/",
                "https://www.instagram.com/matematicasconjuan/",
                "https://www.instagram.com/matematicasdivertidas/",
                "https://www.facebook.com/DerivandoYouTube/",
                "https://www.facebook.com/FESPM/",
                "https://www.facebook.com/groups/198633806930504/",
                "https://www.facebook.com/groups/396517043747386/",
                "https://www.facebook.com/groups/674232839345094/",
                "https://www.tiktok.com/@laurimathteacher",
                "https://www.tiktok.com/@aprende.mates",
                "https://www.tiktok.com/@matemagiks",
                "https://www.tiktok.com/@math2me",
                "https://www.tiktok.com/@aprendeconmaye",
                "https://www.tiktok.com/@profesor10demates"
            ],
            'privacy' => 'public',
            'social_user_id' => 1, 
        ]);
    }
}
