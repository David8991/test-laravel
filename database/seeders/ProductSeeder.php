<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Ноутбук Apple MacBook Air 13',
            'Ноутбук ASUS ZenBook 14',
            'Смартфон Apple iPhone 14',
            'Смартфон Samsung Galaxy S23',
            'Смартфон Xiaomi Redmi Note 12',
            'Планшет Apple iPad 10.9"',
            'Планшет Samsung Galaxy Tab S8',
            'Планшет Lenovo Tab M10',
            'Смарт-часы Apple Watch SE',
            'Смарт-часы Samsung Galaxy Watch 6',
            'Фитнес-браслет Xiaomi Mi Band 8',
            'Наушники Apple AirPods Pro 2',
            'Наушники Samsung Galaxy Buds 2',
            'Наушники Sony WH-1000XM5',
            'Наушники JBL Tune 510BT',
            'Гарнитура Logitech G Pro X',
            'Микрофон Blue Yeti X',
            'Мышь Logitech MX Master 3S',
            'Мышь Razer DeathAdder V2',
            'Клавиатура Logitech MX Keys',
            'Клавиатура Razer BlackWidow V3',
            'Монитор LG UltraGear 27"',
            'Монитор Samsung Smart Monitor M8',
            'Монитор Philips 27E1N5500',
            'Внешний SSD Samsung T7 1TB',
            'Жесткий диск WD Elements 2TB',
            'Флешка SanDisk Ultra 128GB',
            'Карточка памяти Kingston 64GB',
            'Колонка JBL Flip 6',
            'Колонка Sony SRS-XE200',
            'Саундбар Samsung HW-Q60B',
            'Саундбар LG SN6Y',
            'Проектор Xiaomi Mi Smart Compact',
            'Экшн-камера GoPro Hero 11',
            'Автомагнитола Pioneer MVH-S320BT',
            'Роутер TP-Link Archer AX55',
            'Роутер ASUS RT-AX58U',
            'Веб-камера Logitech C920',
            'Принтер HP LaserJet M211',
            'МФУ Canon PIXMA G3411',
            'Пылесос Dyson V15 Detect',
            'Пылесос Xiaomi Mi Robot Vacuum-Mop',
            'Увлажнитель воздуха Xiaomi Smartmi',
            'Очиститель воздуха Levoit Core 300',
            'Электрочайник Xiaomi Mi Electric Kettle',
            'Тостер Philips Daily Collection',
            'Кофемашина DeLonghi Magnifica S',
            'Мультиварка REDMOND RMC-M90',
            'Стиральная машина LG F2V3GS6W',
            'Холодильник Samsung RB37A52',
            'Микроволновка Samsung ME83KRW-1',
            'Плита GEFEST 6100-02',
            'Телевизор Samsung QLED 55"',
            'Телевизор LG OLED 48"',
            'Телевизор Xiaomi Mi TV P1 50"',
            'Геймпад Sony DualSense',
            'Геймпад Xbox Wireless Controller',
            'Игровая приставка Sony PlayStation 5',
            'Игровая приставка Xbox Series X',
            'Сетевой фильтр Pilot GL 5 розеток',
            'Зарядка Baseus GaN2 Pro 65W',
            'Power Bank Xiaomi 20000mAh',
            'Кабель USB-C Anker PowerLine',
            'Док-станция ORICO USB 3.0',
            'Подставка для ноутбука Deepcool',
            'Коврик для мыши SteelSeries QcK',
            'Сумка для ноутбука Samsonite',
            'Рюкзак для ноутбука Xiaomi Urban',
            'Очки виртуальной реальности Oculus Quest 2',
            'Термометр Xiaomi Mi Temperature',
            'Смарт-лампа Yeelight YLDP05YL',
            'Умная розетка TP-Link Tapo P100',
            'Датчик движения Aqara Motion Sensor',
            'Умный звонок Google Nest Doorbell',
            'IP-камера Xiaomi Mi 360° 2K',
            'Система умного дома Aqara Starter Kit',
            'Настольная лампа Xiaomi Mi LED Desk Lamp',
            'Кухонные весы REDMOND RS-736',
            'Калькулятор Casio fx-991ES Plus',
            'Ламинатор Fellowes Saturn 3i',
            'Шредер Office Kit S70',
            'Модем Huawei E3372h',
            'Кулер для процессора DEEPCOOL GAMMAXX 400',
            'Видеокарта NVIDIA GeForce RTX 4070',
            'Процессор AMD Ryzen 7 5800X',
            'Оперативная память Kingston Fury 16GB',
            'SSD M.2 Kingston NV2 1TB',
            'Материнская плата ASUS TUF B550-PLUS',
            'Блок питания be quiet! 650W',
            'Корпус для ПК NZXT H510',
            'Стабилизатор напряжения РЕСАНТА LUX',
            'Удлинитель Xiaomi Mi Power Strip',
            'Ночник Baseus D02',
            'Светильник IKEA RANARP',
            'Часы Xiaomi Mi Smart Clock',
            'Будильник Philips Wake-Up Light',
            'Робот-пылесос Dreame Bot L10s',
            'Погодная станция Netatmo Weather Station',
            'Электросамокат Xiaomi Mi Scooter 4 Pro',
            'Велотренажёр DFC B8105',
            'Массажер для шеи Yamaguchi Axiom',
            'Электрогриль Tefal OptiGrill+',
            'Паровая швабра Kitfort KT-1004',
        ];

        $faker = Faker::create('ru_RU');
        $categories = ProductCategories::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            Product::create([
                'name' => $names[$i],
                'price' => rand(1000, 50000),
                'category_id' => fake()->randomElement($categories),
                'amount' => rand(10, 50000),
                'description' => $faker->boolean(30) ? $faker->realText(100) : null,
            ]);
        }
    }
}
