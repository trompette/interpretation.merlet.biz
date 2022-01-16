<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    /** @test @dataProvider languages */
    public function index_redirects_to_home(string $givenLanguage, string $expectedLocation): void
    {
        $client = static::createClient();
        $client->setServerParameter('HTTP_ACCEPT_LANGUAGE', $givenLanguage);
        $client->request('GET', '/');

        self::assertResponseRedirects($expectedLocation, 302);
    }

    public function languages(): array
    {
        return [
            'french as preferred language' => ['fr', '/french/home'],
            'english as preferred language' => ['en', '/english/home'],
            'russian as preferred language' => ['ru', '/russian/home'],
            'ukrainian as preferred language' => ['uk', '/ukrainian/home'],
            'unknown preferred language' => ['zz', '/french/home'],
        ];
    }

    /** @test @dataProvider pages */
    public function page_title_contains_text(string $givenPath, string $expectedText): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $givenPath);

        self::assertResponseStatusCodeSame(200);
        self::assertStringContainsString($expectedText, $crawler->filter('title')->first()->text());
    }

    public function pages(): array
    {
        return [
            'path for home in french' => ['/french/home', 'Accueil'],
            'path for service in french' => ['/french/service', 'Mes services'],
            'path for experience in french' => ['/french/experience', 'Mon parcours'],
            'path for quote in french' => ['/french/quote', 'Demande de devis'],
            'path for home in english' => ['/english/home', 'Home'],
            'path for service in english' => ['/english/service', 'My services'],
            'path for experience in english' => ['/english/experience', 'Overall background'],
            'path for quote in english' => ['/english/quote', 'Free quote'],
            'path for home in russian' => ['/russian/home', 'Главная'],
            'path for service in russian' => ['/russian/service', 'Мои услуги'],
            'path for experience in russian' => ['/russian/experience', 'Опыт и образование'],
            'path for quote in russian' => ['/russian/quote', 'Бесплатный расчёт стоимости'],
            'path for home in ukrainian' => ['/ukrainian/home', 'Про мене'],
            'path for service in ukrainian' => ['/ukrainian/service', 'Мої послуги'],
            'path for experience in ukrainian' => ['/ukrainian/experience', 'Досвід та освіта'],
            'path for quote in ukrainian' => ['/ukrainian/quote', 'Розрахунок вартості замовлення'],
        ];
    }
}
