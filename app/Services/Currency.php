<?php

namespace App\Services;

use GuzzleHttp\Client;

class Currency
{
    /**
     * @var Client
     */
    private $client;

    private $currencies = [
        ['code' => 'usd', 'name' => 'U.S. Dollar (USD)'],
        ['code' => 'eur', 'name' => 'Euro (EUR)'],
        ['code' => 'gbp', 'name' => 'U.K. Pound Sterling (GBP)'],
        ['code' => 'aud', 'name' => 'Australian Dollar (AUD)'],
        ['code' => 'cad', 'name' => 'Canadian Dollar (CAD)'],
        ['code' => 'jpy', 'name' => 'Japanese Yen (JPY)'],
        ['code' => 'chf', 'name' => 'Swiss Franc (CHF)'],
        ['code' => 'kmf', 'name' => 'Comoro franc (KMF)'],
        ['code' => 'afn', 'name' => 'Afghan afghani (AFN)'],
        ['code' => 'all', 'name' => 'Albanian lek (ALL)'],
        ['code' => 'dzd', 'name' => 'Algerian Dinar (DZD)'],
        ['code' => 'aoa', 'name' => 'Angolan kwanza (AOA)'],
        ['code' => 'ars', 'name' => 'Argentine Peso (ARS)'],
        ['code' => 'amd', 'name' => 'Armenia Dram (AMD)'],
        ['code' => 'awg', 'name' => 'Aruban florin (AWG)'],
        ['code' => 'azn', 'name' => 'Azerbaijan Manat (AZN)'],
        ['code' => 'bsd', 'name' => 'Bahamian Dollar (BSD)'],
        ['code' => 'bhd', 'name' => 'Bahrain Dinar (BHD)'],
        ['code' => 'bdt', 'name' => 'Bangladeshi taka (BDT)'],
        ['code' => 'bbd', 'name' => 'Barbadian Dollar (BBD)'],
        ['code' => 'byr', 'name' => 'Belarussian Ruble (BYR)'],
        ['code' => 'byn', 'name' => 'Belarussian Ruble (BYN)'],
        ['code' => 'bzd', 'name' => 'Belize dollar (BZD)'],
        ['code' => 'bob', 'name' => 'Bolivian Boliviano (BOB)'],
        ['code' => 'bam', 'name' => 'Bosnia and Herzegovina convertible mark (BAM)'],
        ['code' => 'bwp', 'name' => 'Botswana Pula (BWP)'],
        ['code' => 'brl', 'name' => 'Brazilian Real (BRL)'],
        ['code' => 'bnd', 'name' => 'Brunei Dollar (BND)'],
        ['code' => 'bgn', 'name' => 'Bulgarian Lev (BGN)'],
        ['code' => 'bif', 'name' => 'Burundian franc (BIF)'],
        ['code' => 'khr', 'name' => 'Cambodian riel (KHR)'],
        ['code' => 'cve', 'name' => 'Cape Verde escudo (CVE)'],
        ['code' => 'xaf', 'name' => 'Central African CFA Franc (XAF)'],
        ['code' => 'xpf', 'name' => 'CFP Franc (XPF)'],
        ['code' => 'clp', 'name' => 'Chilean Peso (CLP)'],
        ['code' => 'cny', 'name' => 'Chinese Yuan (CNY)'],
        ['code' => 'cop', 'name' => 'Colombian Peso (COP)'],
        ['code' => 'cdf', 'name' => 'Congolese franc (CDF)'],
        ['code' => 'crc', 'name' => 'Costa Rican Colón (CRC)'],
        ['code' => 'hrk', 'name' => 'Croatian Kuna (HRK)'],
        ['code' => 'cup', 'name' => 'Cuban peso (CUP)'],
        ['code' => 'czk', 'name' => 'Czech Koruna (CZK)'],
        ['code' => 'dkk', 'name' => 'Danish Krone (DKK)'],
        ['code' => 'djf', 'name' => 'Djiboutian franc (DJF)'],
        ['code' => 'dop', 'name' => 'Dominican Peso (DOP)'],
        ['code' => 'xcd', 'name' => 'East Caribbean Dollar (XCD)'],
        ['code' => 'egp', 'name' => 'Egyptian Pound (EGP)'],
        ['code' => 'ern', 'name' => 'Eritrean nakfa (ERN)'],
        ['code' => 'etb', 'name' => 'Ethiopian birr (ETB)'],
        ['code' => 'fjd', 'name' => 'Fiji Dollar (FJD)'],
        ['code' => 'gmd', 'name' => 'Gambian dalasi (GMD)'],
        ['code' => 'gel', 'name' => 'Georgian lari (GEL)'],
        ['code' => 'ghs', 'name' => 'Ghanaian Cedi (GHS)'],
        ['code' => 'gip', 'name' => 'Gibraltar pound (GIP)'],
        ['code' => 'gtq', 'name' => 'Guatemalan Quetzal (GTQ)'],
        ['code' => 'gnf', 'name' => 'Guinean franc (GNF)'],
        ['code' => 'gyd', 'name' => 'Guyanese dollar (GYD)'],
        ['code' => 'htg', 'name' => 'Haitian gourde (HTG)'],
        ['code' => 'hnl', 'name' => 'Honduran Lempira (HNL)'],
        ['code' => 'hkd', 'name' => 'Hong Kong Dollar (HKD)'],
        ['code' => 'huf', 'name' => 'Hungarian Forint (HUF)'],
        ['code' => 'isk', 'name' => 'Icelandic Krona (ISK)'],
        ['code' => 'inr', 'name' => 'Indian Rupee (INR)'],
        ['code' => 'idr', 'name' => 'Indonesian Rupiah (IDR)'],
        ['code' => 'irr', 'name' => 'Iranian rial (IRR)'],
        ['code' => 'iqd', 'name' => 'Iraqi dinar (IQD)'],
        ['code' => 'ils', 'name' => 'Israeli New Sheqel (ILS)'],
        ['code' => 'jmd', 'name' => 'Jamaican Dollar (JMD)'],
        ['code' => 'jod', 'name' => 'Jordanian Dinar (JOD)'],
        ['code' => 'kzt', 'name' => 'Kazakhstani Tenge (KZT)'],
        ['code' => 'kes', 'name' => 'Kenyan shilling (KES)'],
        ['code' => 'kwd', 'name' => 'Kuwaiti Dinar (KWD)'],
        ['code' => 'kgs', 'name' => 'Kyrgyzstan Som (KGS)'],
        ['code' => 'lak', 'name' => 'Lao kip (LAK)'],
        ['code' => 'lvl', 'name' => 'Latvian Lats (LVL)'],
        ['code' => 'lbp', 'name' => 'Lebanese Pound (LBP)'],
        ['code' => 'lsl', 'name' => 'Lesotho loti (LSL)'],
        ['code' => 'lrd', 'name' => 'Liberian dollar (LRD)'],
        ['code' => 'lyd', 'name' => 'Libyan Dinar (LYD)'],
        ['code' => 'ltl', 'name' => 'Lithuanian Litas (LTL)'],
        ['code' => 'mop', 'name' => 'Macanese pataca (MOP)'],
        ['code' => 'mkd', 'name' => 'Macedonian denar (MKD)'],
        ['code' => 'mga', 'name' => 'Malagasy ariary (MGA)'],
        ['code' => 'mwk', 'name' => 'Malawian kwacha (MWK)'],
        ['code' => 'myr', 'name' => 'Malaysian Ringgit (MYR)'],
        ['code' => 'mvr', 'name' => 'Maldivian rufiyaa (MVR)'],
        ['code' => 'mro', 'name' => 'Mauritanian Ouguiya (MRO)'],
        ['code' => 'mru', 'name' => 'Mauritanian ouguiya (MRU)'],
        ['code' => 'mur', 'name' => 'Mauritian Rupee (MUR)'],
        ['code' => 'mxn', 'name' => 'Mexican Peso (MXN)'],
        ['code' => 'mdl', 'name' => 'Moldova Lei (MDL)'],
        ['code' => 'mnt', 'name' => 'Mongolian togrog (MNT)'],
        ['code' => 'mad', 'name' => 'Moroccan Dirham (MAD)'],
        ['code' => 'mzn', 'name' => 'Mozambican metical (MZN)'],
        ['code' => 'mmk', 'name' => 'Myanma Kyat (MMK)'],
        ['code' => 'nad', 'name' => 'Namibian dollar (NAD)'],
        ['code' => 'npr', 'name' => 'Nepalese Rupee (NPR)'],
        ['code' => 'ang', 'name' => 'Neth. Antillean Guilder (ANG)'],
        ['code' => 'twd', 'name' => 'New Taiwan Dollar  (TWD)'],
        ['code' => 'tmt', 'name' => 'New Turkmenistan Manat (TMT)'],
        ['code' => 'nzd', 'name' => 'New Zealand Dollar (NZD)'],
        ['code' => 'nio', 'name' => 'Nicaraguan Córdoba (NIO)'],
        ['code' => 'ngn', 'name' => 'Nigerian Naira (NGN)'],
        ['code' => 'nok', 'name' => 'Norwegian Krone (NOK)'],
        ['code' => 'omr', 'name' => 'Omani Rial (OMR)'],
        ['code' => 'pkr', 'name' => 'Pakistani Rupee (PKR)'],
        ['code' => 'pab', 'name' => 'Panamanian Balboa (PAB)'],
        ['code' => 'pgk', 'name' => 'Papua New Guinean kina (PGK)'],
        ['code' => 'pyg', 'name' => 'Paraguayan Guaraní (PYG)'],
        ['code' => 'pen', 'name' => 'Peruvian Nuevo Sol (PEN)'],
        ['code' => 'php', 'name' => 'Philippine Peso (PHP)'],
        ['code' => 'pln', 'name' => 'Polish Zloty (PLN)'],
        ['code' => 'qar', 'name' => 'Qatari Rial (QAR)'],
        ['code' => 'ron', 'name' => 'Romanian New Leu (RON)'],
        ['code' => 'rub', 'name' => 'Russian Rouble (RUB)'],
        ['code' => 'rwf', 'name' => 'Rwandan franc (RWF)'],
        ['code' => 'svc', 'name' => 'Salvadoran colon (SVC)'],
        ['code' => 'wst', 'name' => 'Samoan tala (WST)'],
        ['code' => 'stn', 'name' => 'São Tomé and Príncipe Dobra (STN)'],
        ['code' => 'sar', 'name' => 'Saudi Riyal (SAR)'],
        ['code' => 'rsd', 'name' => 'Serbian Dinar (RSD)'],
        ['code' => 'scr', 'name' => 'Seychelles rupee (SCR)'],
        ['code' => 'sll', 'name' => 'Sierra Leonean leone (SLL)'],
        ['code' => 'sgd', 'name' => 'Singapore Dollar (SGD)'],
        ['code' => 'sbd', 'name' => 'Solomon Islands dollar (SBD)'],
        ['code' => 'sos', 'name' => 'Somali shilling (SOS)'],
        ['code' => 'zar', 'name' => 'South African Rand (ZAR)'],
        ['code' => 'krw', 'name' => 'South Korean Won (KRW)'],
        ['code' => 'ssp', 'name' => 'South Sudanese pound (SSP)'],
        ['code' => 'lkr', 'name' => 'Sri Lanka Rupee (LKR)'],
        ['code' => 'sdg', 'name' => 'Sudanese pound (SDG)'],
        ['code' => 'srd', 'name' => 'Surinamese dollar (SRD)'],
        ['code' => 'szl', 'name' => 'Swazi lilangeni (SZL)'],
        ['code' => 'sek', 'name' => 'Swedish Krona (SEK)'],
        ['code' => 'syp', 'name' => 'Syrian pound (SYP)'],
        ['code' => 'tjs', 'name' => 'Tajikistan Ruble (TJS)'],
        ['code' => 'tzs', 'name' => 'Tanzanian shilling (TZS)'],
        ['code' => 'thb', 'name' => 'Thai Baht (THB)'],
        ['code' => 'top', 'name' => 'Tongan paʻanga (TOP)'],
        ['code' => 'ttd', 'name' => 'Trinidad Tobago Dollar (TTD)'],
        ['code' => 'tnd', 'name' => 'Tunisian Dinar (TND)'],
        ['code' => 'try', 'name' => 'Turkish Lira (TRY)'],
        ['code' => 'aed', 'name' => 'U.A.E Dirham (AED)'],
        ['code' => 'ugx', 'name' => 'Ugandan shilling (UGX)'],
        ['code' => 'uah', 'name' => 'Ukrainian Hryvnia (UAH)'],
        ['code' => 'uyu', 'name' => 'Uruguayan Peso (UYU)'],
        ['code' => 'uzs', 'name' => 'Uzbekistan Sum (UZS)'],
        ['code' => 'vuv', 'name' => 'Vanuatu vatu (VUV)'],
        ['code' => 'vef', 'name' => 'Venezuelan Bolivar (VEF)'],
        ['code' => 'vnd', 'name' => 'Vietnamese Dong (VND)'],
        ['code' => 'xof', 'name' => 'West African CFA Franc (XOF)'],
        ['code' => 'yer', 'name' => 'Yemeni rial (YER)'],
        ['code' => 'zmw', 'name' => 'Zambian kwacha (ZMW)'],
    ];

    /**
     * Currency constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get()
    {
        return collect($this->currencies);
    }

    /**
     * Gets the rate for a currency.
     * @return \Illuminate\Support\Collection
     */
    public function getRate($currency = 'gbp')
    {
        return collect(
            json_decode($this->client->get("http://www.floatrates.com/daily/$currency.json")->getBody())
        );
    }

    public function calculate($data)
    {
        //dd($data['from_currency']);

        $to_currency = $this->getRate($data['from_currency'])->where('code', strtoupper($data['to_currency']))->first();


        $to_amount = round($data['from_amount'] * $to_currency->rate, 2);

        return (object)[
            'to_amount' => $to_amount,
            'to_rate' => $to_currency->rate,
            'to_date' => $to_currency->date,
        ];
    }
}