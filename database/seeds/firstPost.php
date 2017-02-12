<?php

use Illuminate\Database\Seeder;

class firstPost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        
        $id = DB::table('posts')->insertGetId(
            ['titulo' => 'Nuevo Post!', 'hora' => $date, 'autor' => 'Juan', 'resumen' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'contenido' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vulputate libero mauris, vitae malesuada mauris porttitor at. Nam scelerisque enim ac libero mattis pharetra sit amet eget neque. Fusce et efficitur nunc. Quisque maximus dui ut tellus condimentum, sit amet sollicitudin ex porta. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse aliquet, arcu quis dignissim vehicula, velit nulla tincidunt neque, ac volutpat erat urna nec risus. Maecenas imperdiet, est sed pretium mollis, nulla ante rhoncus nisi, ac tincidunt est ipsum non quam. Nunc id leo quis ligula elementum efficitur.', 'imagen' => './assets/noticia_img.png',
            'imgmini' => './assets/IMAGEN DE NOTICIA.jpg', 'visitas' => '0', 'programada' => $date, 'status' => 'publicada', 'created_at' => $date, 'updated_at' => $date]
        );
    }
}
