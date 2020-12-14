<?php 
class Redirect{
    private $location;

    public static function to($location){
        $self = new self();
        $self->location = $location;
        if(headers_sent()){
            echo '
                <script>
                    window.location.href="'.URL.$self->location.'"
                </script>
            ';
            echo '<meta http-equiv="refresh" content="0;url='.URL.$self->location.'"/>';
            die();
        }

        //Cuadno pasamoa una url externa a niuestro sitio
        if(strpos($self->location, 'http') !== false){
            header('location: '.$self->location);
            die();
        }
        //Redirigir al usuario a otra seccion
        header('location: '.URL.$self->location);
        die();
    }
}