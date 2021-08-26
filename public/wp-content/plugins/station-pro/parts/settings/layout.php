<?php
/*
Title: Setting color of player
Setting: piklist_core
Tab: Layout
Flow: General
*/


piklist('field', array(
    'type' => 'hidden',
    'field' => 'root_url',
    'value' =>  '' . get_site_url() . ''
));


piklist('field', array(
    'type' => 'checkbox',
    'field' => 'transparent',
    'label' =>  'Show transparent navbar',
    'value' => '', // set default value
    'choices' => array(
        'bg-opacity-75' => 'Show navbar player in 50% transparent',

    )
));


if (stationpro()->is_plan('premium', true)) {


    piklist('field', array(
        'type' => 'radio',
        'field' => 'bg_color',
        'class' => 'piklist-field-type-radio piklist-field-type-radio-radio',
        'label' => 'Choose your player color:',
        'choices' => array(

            'blue' => '<div class="block w-16 float-right  mb-2 text-center text-white rounded-sm  p-2 shadow bg-blue-500  ">Blue</div>',

            'gray' => '<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-gray-500 p-2 ">Gray</div>',
            'red' => '<div class="block w-16 float-right   mb-2  text-center text-white rounded-sm shadow bg-red-500 p-2 ">Red</div>',
            'yellow' => '<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-yellow-500 p-2 ">Yellow</div>',
            'green' => '<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-green-500 p-2 ">Green</div>',
            'indigo' => '<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-indigo-500 p-2 ">Indigo</div>',
            'pink' => '<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-pink-500 p-2 ">Pink</div>',
            'purple' => '<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-purple-500 p-2 ">Purple</div>'
        )
    ));
} else {

    piklist('field', array(
        'type' => 'radio',
        'field' => 'bg_color',
        'reset' => 'true',
        'class' => 'piklist-field-type-radio piklist-field-type-radio-radio',
        'label' => 'Choose your player color:',
        'choices' => array(
            'blue' => '<div class="block w-16 float-right  mb-2 text-center text-white rounded-sm  p-2 shadow bg-blue-500  ">Blue</div>',
        )
    ));
}

if (stationpro()->is_plan('premium', true)) {
    piklist('field', array(
        'type' => 'checkbox',
        'field' => 'shere',
        'class' => 'piklist-field-type-radio piklist-field-type-radio-radio',
        'label' => 'Show icons in Player:',
        'choices' => array(
            'facebook' => '<i class="fab fa-facebook"></i> Facebook',
            'twitter' => '<i class="fab fa-twitter"></i>  Twitter',
            'whatsApp' => '<i class="fab fa-whatsapp"></i>  WhatsApp',
            'telegram' => '<i class="fab fa-telegram"></i>  Telegram',
            'linkedin' => '<i class="fab fa-linkedin"></i>  Linkedin',
            'pinterest' => '<i class="fab fa-pinterest"></i>  Pinterest',
            'email' => '<i class="fas fa-envelope"></i>  E-mail',
        )
    ));
}

if (stationpro()->is_plan('premium', true)) {
} else {

?>


    <div class="absolute top-5 right-2">

        <a href="<?php echo stationpro()->get_upgrade_url() ?>" class="bg-indigo-700 text-white font-bold hover:text-white hover:bg-indigo-500 block py-5 rounded-md w-80 transition duration-500 text-center float-right shadow-md p-3" title="upgrade to premium">Get More Color custom in Premium Version</a>

    </div>


<?php } ?>

<style type="text/css">
    @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css");
    @import "https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css";

    h2,
    h3 {
        color: #1d2327;
        font-size: 1.3em;
        margin: 1em 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {

        font-weight: 600;
    }



    .piklist-field-type-radio-radio input+.piklist-field-type-radio_indicator::before {
        animation: s-ripple 250ms ease-out;
    }

    .piklist-field-type-radio-radio input:checked+.piklist-field-type-radio_indicator::before {
        animation-name: s-ripple-dup;
    }
</style>