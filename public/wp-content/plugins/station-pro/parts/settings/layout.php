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
    'label' =>  _e('Show transparent navbar', 'picklist'),
    'value' => '', // set default value
    'choices' => array(
        'bg-opacity-75' => _e('Show navbar player in 50% transparent', 'picklist'),

    )
));


if (stationpro()->is_plan('premium', true)) {


    piklist('field', array(
        'type' => 'radio',
        'field' => 'bg_color',
        'class' => 'piklist-field-type-radio piklist-field-type-radio-radio',
        'label' => _e('Choose your player color:', 'picklist'),
        'choices' => array(

            'blue' => _e('<div class="block w-16 float-right  mb-2 text-center text-white rounded-sm  p-2 shadow bg-blue-500  ">Blue</div>', 'picklist'),

            'gray' => _e('<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-gray-500 p-2 ">Gray</div>', 'picklist'),
            'red' => _e('<div class="block w-16 float-right   mb-2  text-center text-white rounded-sm shadow bg-red-500 p-2 ">Red</div>', 'picklist'),
            'yellow' => _e('<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-yellow-500 p-2 ">Yellow</div>', 'picklist'),
            'green' => _e('<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-green-500 p-2 ">Green</div>', 'picklist'),
            'indigo' => _e('<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-indigo-500 p-2 ">Indigo</div>', 'picklist'),
            'pink' => _e('<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-pink-500 p-2 ">Pink</div>', 'picklist'),
            'purple' => _e('<div class="block w-16 float-right   mb-2 text-center text-white rounded-sm shadow bg-purple-500 p-2 ">Purple</div>', 'picklist')
        )
    ));
} else {

    piklist('field', array(
        'type' => 'radio',
        'field' => 'bg_color',
        'reset' => 'true',
        'class' => 'piklist-field-type-radio piklist-field-type-radio-radio',
        'label' => _e('Choose your player color:', 'picklist'),
        'choices' => array(
            'blue' => _e('<div class="block w-16 float-right  mb-2 text-center text-white rounded-sm  p-2 shadow bg-blue-500  ">Blue</div>', 'picklist'),
        )
    ));
}

if (stationpro()->is_plan('premium', true)) {
    piklist('field', array(
        'type' => 'checkbox',
        'field' => 'shere',
        'class' => 'piklist-field-type-radio piklist-field-type-radio-radio',
        'label' => _e('Show icons in Player:', 'picklist'),
        'choices' => array(
            'facebook' => _e('<i class="fab fa-facebook"></i> Facebook', 'picklist'),
            'twitter' => _e('<i class="fab fa-twitter"></i>  Twitter', 'picklist'),
            'whatsApp' => _e('<i class="fab fa-whatsapp"></i>  WhatsApp', 'picklist'),
            'telegram' => _e('<i class="fab fa-telegram"></i>  Telegram', 'picklist'),
            'linkedin' => _e('<i class="fab fa-linkedin"></i>  Linkedin', 'picklist'),
            'pinterest' => _e('<i class="fab fa-pinterest"></i>  Pinterest', 'picklist'),
            'email' => _e('<i class="fas fa-envelope"></i>  E-mail', 'picklist'),
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

    .piklist-field-type-radio {
        font-family: arial;
        display: block;
        position: relative;
        padding-left: 31px;
        margin-bottom: 8px;
        padding-top: 2px;
        cursor: pointer;
        font-size: 16px;
    }

    .piklist-field-type-radio input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }

    .piklist-field-type-radio_indicator {
        position: absolute;
        top: 1px;
        left: 0;
        height: 20px;
        width: 20px;
        background: #e6e6e6;
        border: 0px solid #000000;
        border-radius: undefinedpx;
    }

    .piklist-field-type-radio:hover input~.piklist-field-type-radio_indicator,
    .piklist-field-type-radio input:focus~.piklist-field-type-radio_indicator {
        background: #cccccc;
    }

    .piklist-field-type-radio input:checked~.piklist-field-type-radio_indicator {
        background: #2a78c0;
    }

    .piklist-field-type-radio:hover input:not([disabled]):checked~.piklist-field-type-radio_indicator,
    .piklist-field-type-radio input:checked:focus~.piklist-field-type-radio_indicator {
        background: #0e6647d;
    }

    .piklist-field-type-radio input:disabled~.piklist-field-type-radio_indicator {
        background: #e6e6e6;
        opacity: 0.6;
        pointer-events: none;
    }

    .piklist-field-type-radio_indicator:after {
        box-sizing: unset;
        content: '';
        position: absolute;
        display: none;
    }

    .piklist-field-type-radio input:checked~.piklist-field-type-radio_indicator:after {
        display: block;
    }

    .piklist-field-type-radio-radio .piklist-field-type-radio_indicator {
        border-radius: 50%;
    }

    .piklist-field-type-radio-radio .piklist-field-type-radio_indicator:after {
        left: 7px;
        top: 7px;
        height: 6px;
        width: 6px;
        border-radius: 50%;
        background: #ffffff;
        transition: background 250ms;
    }

    .piklist-field-type-radio-radio input:disabled~.piklist-field-type-radio_indicator:after {
        background: #7b7b7b;
    }

    .piklist-field-type-radio-radio .piklist-field-type-radio_indicator::before {
        content: '';
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 4.5rem;
        height: 4.5rem;
        margin-left: -1.3rem;
        margin-top: -1.3rem;
        background: #2aa1c0;
        border-radius: 3rem;
        opacity: 0.6;
        z-index: 99999;
        transform: scale(0);
    }

    @keyframes s-ripple {
        0% {
            opacity: 0;
            transform: scale(0);
        }

        20% {
            transform: scale(1);
        }

        100% {
            opacity: 0.01;
            transform: scale(1);
        }
    }

    @keyframes s-ripple-dup {
        0% {
            transform: scale(0);
        }

        30% {
            transform: scale(1);
        }

        60% {
            transform: scale(1);
        }

        100% {
            opacity: 0;
            transform: scale(1);
        }
    }

    .piklist-field-type-radio-radio input+.piklist-field-type-radio_indicator::before {
        animation: s-ripple 250ms ease-out;
    }

    .piklist-field-type-radio-radio input:checked+.piklist-field-type-radio_indicator::before {
        animation-name: s-ripple-dup;
    }
</style>