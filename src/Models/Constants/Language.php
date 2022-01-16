<?php

namespace WalkerChiu\Core\Models\Constants;

use WalkerChiu\Core\Models\Services\ArrayOptionFactory;

/**
 * @license MIT
 * @package WalkerChiu\Core
 *
 * Language Code ISO 639-1
 */

class Language
{
    /**
     * @param String  $delimiter
     * @return Array
     */
    public static function getCodes($delimiter = null): array
    {
        $items = [];
        $zones = self::all();
        foreach ($zones as $code => $zone) {
            array_push($items, $code);
        }

        $factory = new ArrayOptionFactory('_', $delimiter);
        $output = $factory->transformValue($items);

        return $output;
    }

    /**
     * @param String  $delimiter
     * @return Array
     */
    public static function options($delimiter = null): array
    {
        $zones = self::all();
        $items = \Lang::get('php-core::language');
        foreach ($items as $code => $zone) {
            if ($zone != $zones[$code])
                $items[$code] = $zone .' - '. $zones[$code];
        }

        $factory = new ArrayOptionFactory('_', $delimiter);
        $output = $factory->transformKey($items);

        return $output;
    }

    /**
     * @return Array
     */
    public static function all(): array
    {
        return [
            'aa'    => 'Afar',
            'ab'    => 'Abkhazian',
            'af'    => 'Afrikaans',
            'am'    => 'Amharic',
            'ar'    => 'Arabic',
            'ar_ae' => 'Arabic (U.A.E.)',
            'ar_bh' => 'Arabic (Bahrain)',
            'ar_dz' => 'Arabic (Algeria)',
            'ar_eg' => 'Arabic (Egypt)',
            'ar_iq' => 'Arabic (Iraq)',
            'ar_jo' => 'Arabic (Jordan)',
            'ar_kw' => 'Arabic (Kuwait)',
            'ar_lb' => 'Arabic (Lebanon)',
            'ar_ly' => 'Arabic (libya)',
            'ar_ma' => 'Arabic (Morocco)',
            'ar_om' => 'Arabic (Oman)',
            'ar_qa' => 'Arabic (Qatar)',
            'ar_sa' => 'Arabic (Saudi Arabia)',
            'ar_sy' => 'Arabic (Syria)',
            'ar_tn' => 'Arabic (Tunisia)',
            'ar_ye' => 'Arabic (Yemen)',
            'as'    => 'Assamese',
            'ay'    => 'Aymara',
            'az'    => 'Azeri',
            'ba'    => 'Bashkir',
            'be'    => 'Belarusian',
            'bg'    => 'Bulgarian',
            'bh'    => 'Bihari',
            'bi'    => 'Bislama',
            'bn'    => 'Bengali',
            'bo'    => 'Tibetan',
            'br'    => 'Breton',
            'ca'    => 'Catalan',
            'co'    => 'Corsican',
            'cs'    => 'Czech',
            'cy'    => 'Welsh',
            'da'    => 'Danish',
            'de'    => 'German',
            'de_at' => 'German (Austria)',
            'de_ch' => 'German (Switzerland)',
            'de_li' => 'German (Liechtenstein)',
            'de_lu' => 'German (Luxembourg)',
            'div'   => 'Divehi',
            'dz'    => 'Bhutani',
            'el'    => 'Greek',
            'en'    => 'English',
            'en_au' => 'English (Australia)',
            'en_bz' => 'English (Belize)',
            'en_ca' => 'English (Canada)',
            'en_gb' => 'English (United Kingdom)',
            'en_ie' => 'English (Ireland)',
            'en_jm' => 'English (Jamaica)',
            'en_nz' => 'English (New Zealand)',
            'en_ph' => 'English (Philippines)',
            'en_tt' => 'English (Trinidad)',
            'en_us' => 'English (United States)',
            'en_za' => 'English (South Africa)',
            'en_zw' => 'English (Zimbabwe)',
            'eo'    => 'Esperanto',
            'es'    => 'Spanish',
            'es_ar' => 'Spanish (Argentina)',
            'es_bo' => 'Spanish (Bolivia)',
            'es_cl' => 'Spanish (Chile)',
            'es_co' => 'Spanish (Colombia)',
            'es_cr' => 'Spanish (Costa Rica)',
            'es_do' => 'Spanish (Dominican Republic)',
            'es_ec' => 'Spanish (Ecuador)',
            'es_es' => 'Spanish (España)',
            'es_gt' => 'Spanish (Guatemala)',
            'es_hn' => 'Spanish (Honduras)',
            'es_mx' => 'Spanish (Mexico)',
            'es_ni' => 'Spanish (Nicaragua)',
            'es_pa' => 'Spanish (Panama)',
            'es_pe' => 'Spanish (Peru)',
            'es_pr' => 'Spanish (Puerto Rico)',
            'es_py' => 'Spanish (Paraguay)',
            'es_sv' => 'Spanish (El Salvador)',
            'es_us' => 'Spanish (United States)',
            'es_uy' => 'Spanish (Uruguay)',
            'es_ve' => 'Spanish (Venezuela)',
            'et'    => 'Estonian',
            'eu'    => 'Basque',
            'fa'    => 'Farsi',
            'fi'    => 'Finnish',
            'fj'    => 'Fiji',
            'fo'    => 'Faeroese',
            'fr'    => 'French',
            'fr_be' => 'French (Belgium)',
            'fr_ca' => 'French (Canada)',
            'fr_ch' => 'French (Switzerland)',
            'fr_lu' => 'French (Luxembourg)',
            'fr_mc' => 'French (Monaco)',
            'fy'    => 'Frisian',
            'ga'    => 'Irish',
            'gd'    => 'Gaelic',
            'gl'    => 'Galician',
            'gn'    => 'Guarani',
            'gu'    => 'Gujarati',
            'ha'    => 'Hausa',
            'he'    => 'Hebrew',
            'hi'    => 'Hindi',
            'hr'    => 'Croatian',
            'hu'    => 'Hungarian',
            'hy'    => 'Armenian',
            'ia'    => 'Interlingua',
            'id'    => 'Indonesian',
            'ie'    => 'Interlingue',
            'ik'    => 'Inupiak',
            'in'    => 'Indonesian',
            'is'    => 'Icelandic',
            'it'    => 'Italian',
            'it_ch' => 'Italian (Switzerland)',
            'iw'    => 'Hebrew',
            'ja'    => 'Japanese',
            'ji'    => 'Yiddish',
            'jw'    => 'Javanese',
            'ka'    => 'Georgian',
            'kk'    => 'Kazakh',
            'kl'    => 'Greenlandic',
            'km'    => 'Cambodian',
            'kn'    => 'Kannada',
            'ko'    => 'Korean',
            'kok'   => 'Konkani',
            'ks'    => 'Kashmiri',
            'ku'    => 'Kurdish',
            'ky'    => 'Kirghiz',
            'kz'    => 'Kyrgyz',
            'la'    => 'Latin',
            'ln'    => 'Lingala',
            'lo'    => 'Laothian',
            'ls'    => 'Slovenian',
            'lt'    => 'Lithuanian',
            'lv'    => 'Latvian',
            'mg'    => 'Malagasy',
            'mi'    => 'Maori',
            'mk'    => 'FYRO Macedonian',
            'ml'    => 'Malayalam',
            'mn'    => 'Mongolian',
            'mo'    => 'Moldavian',
            'mr'    => 'Marathi',
            'ms'    => 'Malay',
            'mt'    => 'Maltese',
            'my'    => 'Burmese',
            'na'    => 'Nauru',
            'nb_no' => 'Norwegian (Bokmal)',
            'ne'    => 'Nepali (India)',
            'nl'    => 'Dutch',
            'nl_be' => 'Dutch (Belgium)',
            'nn_no' => 'Norwegian',
            'no'    => 'Norwegian (Bokmal)',
            'oc'    => 'Occitan',
            'om'    => '(Afan)/Oromoor/Oriya',
            'or'    => 'Oriya',
            'pa'    => 'Punjabi',
            'pl'    => 'Polish',
            'ps'    => 'Pashto/Pushto',
            'pt'    => 'Portuguese',
            'pt_br' => 'Portuguese (Brazil)',
            'qu'    => 'Quechua',
            'rm'    => 'Rhaeto-Romanic',
            'rn'    => 'Kirundi',
            'ro'    => 'Romanian',
            'ro_md' => 'Romanian (Moldova)',
            'ru'    => 'Russian',
            'ru_md' => 'Russian (Moldova)',
            'rw'    => 'Kinyarwanda',
            'sa'    => 'Sanskrit',
            'sb'    => 'Sorbian',
            'sd'    => 'Sindhi',
            'sg'    => 'Sangro',
            'sh'    => 'Serbo-Croatian',
            'si'    => 'Singhalese',
            'sk'    => 'Slovak',
            'sl'    => 'Slovenian',
            'sm'    => 'Samoan',
            'sn'    => 'Shona',
            'so'    => 'Somali',
            'sq'    => 'Albanian',
            'sr'    => 'Serbian',
            'ss'    => 'Siswati',
            'st'    => 'Sesotho',
            'su'    => 'Sundanese',
            'sv'    => 'Swedish',
            'sv_fi' => 'Swedish (Finland)',
            'sw'    => 'Swahili',
            'sx'    => 'Sutu',
            'syr'   => 'Syriac',
            'ta'    => 'Tamil',
            'te'    => 'Telugu',
            'tg'    => 'Tajik',
            'th'    => 'Thai',
            'ti'    => 'Tigrinya',
            'tk'    => 'Turkmen',
            'tl'    => 'Tagalog',
            'tn'    => 'Tswana',
            'to'    => 'Tonga',
            'tr'    => 'Turkish',
            'ts'    => 'Tsonga',
            'tt'    => 'Tatar',
            'tw'    => 'Twi',
            'uk'    => 'Ukrainian',
            'ur'    => 'Urdu',
            'us'    => 'English',
            'uz'    => 'Uzbek',
            'vi'    => 'Vietnamese',
            'vo'    => 'Volapuk',
            'wo'    => 'Wolof',
            'xh'    => 'Xhosa',
            'yi'    => 'Yiddish',
            'yo'    => 'Yoruba',
            'zh'    => 'Chinese',
            'zh_cn' => 'Chinese (China)',
            'zh_hk' => 'Chinese (Hong Kong SAR)',
            'zh_mo' => 'Chinese (Macau SAR)',
            'zh_sg' => 'Chinese (Singapore)',
            'zh_tw' => 'Chinese (Taiwan)',
            'zu'    => 'Zulu'
        ];
    }
}
