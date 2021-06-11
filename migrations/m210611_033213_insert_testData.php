<?php

use yii\db\Migration;

/**
 * Class m210611_033213_insert_testData
 */
class m210611_033213_insert_testData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'username' => 'user',
            'auth_key' => 'W-3CXQLsgWnFVlbhTQwv3r2tbbnwi1Po',
            'password_hash' => '$2y$13$JpvNQvfv.KbOEvQ9xAhfJOd0ZFiEM4nq7ssy6UpH5ipLPaqy6yFAm',
            'email' => 'user@example.com',
            'status' => 10,
            'created_at' => '2021-06-01 23:36:04',
            'updated_at' => '2021-06-01 23:36:04',
            'verification_token' => '-hlW9WyWLC6MPTFRf-1arCLhHsa4m1wH_1623333469',
            'isAdmin' => 0,
        ]);

        $this->insert('user', [
            'username' => 'qwerty',
            'auth_key' => '4ouIAQJyPiBptLHJgHhI3G3YkRZofkgz',
            'password_hash' => '$2y$13$izSSwwbClJjACUGwD19oZOBfr/FpnV6lGGhgCxoPaZRSfIxsxuLoK',
            'email' => 'qwerty@example.com',
            'status' => 10,
            'created_at' => '2021-06-01 23:36:04',
            'updated_at' => '2021-06-05 23:36:04',
            'verification_token' => 'P-2gUthp2UJ_IWBTAYDjNiKM4JvRwEwg_1623382564',
            'isAdmin' => 0,
        ]);

        for ($i = 0; $i < 3; $i++) {
            $this->insert('post', [
                'user_id' => 1,
                'title' => 'Создание галереи изображений на CSS сетке (с эффектом размытия и медиа запросами)',
                'content' => '
                В этом уроке мы возьмём пачку ссылок на обычные миниатюры изображений и превратим их в отзывчивую галерею на CSS сетке, с эффектом размытия при наведении. А ещё мы применим крутой CSS трюк, чтобы это всё работало на тач-скринах.
                Вот что мы будем создавать:
                Немного фона
                Недавно, Рэйчел МакКоллин написала урок, объясняющий то, как в тему WordPress добавить галерею на основе ссылок на изображения.

                WORDPRESS
                Create a WordPress Image Gallery: Code the Plugin
                Rachel McCollin
                Эти ссылки действуют в качестве навигации для дочерних страниц, не зависимо от того на какой странице пользователь (или какую страницу вы выберите), а итоговый плагин выводит что-то типа этого:',
                'created_at' => '2021-06-03',
                'updated_at' => '2021-06-03',
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            $this->insert('post', [
                'user_id' => 2,
                'title' => 'CSS Gallery Examples 2020',
                'content' => '
                47+ Best CSS Gallery Examples from hundreds of the CSS Gallery reviews in the market (Codepen.io) as 
                derived from Avada Commerce Ranking which is using Avada Commerce scores, rating reviews, search 
                results, social metrics. The bellow reviews were picked manually by Avada Commerce experts, if your 
                CSS Gallery does not include in the list, feel free to contact us. The best CSS Gallery css collection 
                is ranked and result in August 2020. You can find free CSS Gallery examples or alternatives to 
                CSS Gallery also.',
                'created_at' => '2021-06-05',
                'updated_at' => '2021-06-05',
            ]);

            $this->insert('post', [
                'user_id' => 1,
                'title' => 'Создание галереи изображений на CSS сетке (с эффектом размытия и медиа запросами)',
                'content' => '
                В этом уроке мы возьмём пачку ссылок на обычные миниатюры изображений и превратим их в отзывчивую галерею на CSS сетке, с эффектом размытия при наведении. А ещё мы применим крутой CSS трюк, чтобы это всё работало на тач-скринах.
                Вот что мы будем создавать:
                Немного фона
                Недавно, Рэйчел МакКоллин написала урок, объясняющий то, как в тему WordPress добавить галерею на основе ссылок на изображения.

                WORDPRESS
                Create a WordPress Image Gallery: Code the Plugin
                Rachel McCollin
                Эти ссылки действуют в качестве навигации для дочерних страниц, не зависимо от того на какой странице пользователь (или какую страницу вы выберите), а итоговый плагин выводит что-то типа этого:',
                'created_at' => '2021-06-03',
                'updated_at' => '2021-06-03',
            ]);

            $this->insert('post', [
                'user_id' => 3,
                'title' => '10 лучших WordPress Twitter виджетов',
                'content' => '
                    С тех пор, как Twitter несколько лет назад изменил свой API, я думаю, что сторонние разработчики 
                    не решаются разрабатывать приложения и плагины, которые интегрируются с Twitter. Когда вы 
                    принимаете решение о сомнительном будущем и более поздних изменениях (удаляя счетчики Twitter), 
                    легко понять, почему количество приложений и плагинов Twitter является разреженным.
                    Но Twitter все еще очень активен, и есть еще несколько разработчиков, которые хотят разрабатывать 
                    решения, которые смогут интегрироваться как можно лучше. Даже отмена подсчетов в Twitter была 
                    недостаточной для того, чтобы разработчики не смогли найти обходные пути.',
                'created_at' => '2021-06-07',
                'updated_at' => '2021-06-07',
            ]);
        }


        $this->insert('comment', [
            'username' => 'Cody',
            'text' => 'Как человек, которому нравится использовать Twitter лично и по-прежнему использует его в качестве жизнеспособной платформы, я рад поделиться десятью лучшими плагинами виджета WordPress Twitter на CodeCanyon и загрузить их бесплатно.',
            'created_at' => '2021-06-09 18:59:06',
            'updated_at' => '2021-06-09 18:59:06',
            'post_id' => 1,
        ]);
        $this->insert('comment', [
            'username' => 'Dane',
            'text' => 'Tweetlab - слайдер Twitter & Usercard для WordPress - это красиво оформленный виджет Twitter WordPress.',
            'created_at' => '2021-06-10 18:59:06',
            'updated_at' => '2021-06-10 18:59:06',
            'post_id' => 1,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210611_033213_insert_testData cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210611_033213_insert_testData cannot be reverted.\n";

        return false;
    }
    */
}
