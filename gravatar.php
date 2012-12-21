<?php

require "lib/gravatar.php";

class Gravatar extends Modules {

        static function __install() {
            $config = Config::current();
            $config->set("gravatar_size", 42);
            $config->set("gravatar_rating", "g");
            $config->set("gravatar_image", "404");
            $config->set("gravatar_use_https", false);
        }

        static function __uninstall($confirm) {
            $config = Config::current();
            $config->remove("gravatar_size");
            $config->remove("gravatar_rating");
            $config->remove("gravatar_image");
            $config->remove("gravatar_use_https");
        }

        static function settings_nav($navs) {
            $navs["gravatar_settings"] = array("title" => __("Gravatar", "gravatar"));
            return $navs;
        }

        static function admin_gravatar_settings($admin) {
            if (empty($_POST))
                return $admin->display("gravatar_settings");

            if (!isset($_POST['hash']) or $_POST['hash'] != Config::current()->secure_hashkey)
                show_403(__("Access Denied"), __("Invalid security key."));
            $config = Config::current();
            $set = array($config->set("gravatar_size", $_POST['gravatar_size']),
                         $config->set("gravatar_rating", $_POST['gravatar_rating']),
                         $config->set("gravatar_image", $_POST['gravatar_image']),
                         $config->set("gravatar_use_https", $_POST['gravatar_use_https'])
                         );

            if (!in_array(false, $set))
                Flash::notice(__("Settings updated."), "/admin/?action=gravatar_settings");
        }

        # To be used in the Twig template as ${ post.autor.email | get_gravatar }
        static function get_gravatar($email) {
            $config = Config::current();
            $params = array(
                'size' => $config->gravatar_size,
                'rating' => $config->gravatar_rating,
                'image' => $config->gravatar_image,
                'secure' => $config->gravatar_use_https
            );

            $url  = Gravatar_lib::url($email,$params);
            return $url;
        }
}
