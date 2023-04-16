<?php

    class Thumbnail {

        protected $id;
        protected $menu;
        protected $color;
        protected $picture;
        protected $reference;
        protected $order;

        public function __construct ($argId, $argMenu, $argColor, $argPicture, $argReference, $argOrder) {
            $this->id = $argId;
            $this->menu = $argMenu;
            $this->color = $argColor;
            $this->picture = $argPicture;
            $this->reference = $argReference;
            $this->order = $argOrder;
        }

        public function getId () {
            return $this->id;
        }

        public function getMenu () {
            return $this->menu;
        }

        public function getColor () {
            return $this->color;
        }

        public function getPicture () {
            return $this->picture;
        }

        public function getReference () {
            return $this->reference;
        }

        public function getOrder () {
            return $this->order;
        }
    }

    $poleThumbnails = [
        'weather' => new Thumbnail ("weather", "Předpověď počasí", "black", "weather_picture.png", "/weather-app", 1),
        'kalendar' => new Thumbnail ("kalendar", "České svátky kalendář", "black", "app_picture.png", "https://play.google.com/store/apps/details?id=funkacer.ceskesvatkykalendar", 2),
        'penzion' => new Thumbnail ("penzion", "Prima-penzion", "black", "primapenzion-main.jpg", "/prima-penzion", 3),
        'prevodnik' => new Thumbnail ("prevodnik", "Převodník teplot", "black", "temp_picture.png", "/prevodnik-teplot", 4),
        'nasobilka' => new Thumbnail ("nasobilka", "Malá násobilka", "black", "nasobilka_picture.png", "/mala-nasobilka", 5)
    ];

?>