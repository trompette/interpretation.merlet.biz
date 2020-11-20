<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    /** @test */
    public function index_redirects()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        self::assertTrue($client->getResponse()->isRedirect());
    }

    /** @test @dataProvider pages */
    public function page_contains_string($path, $text)
    {
        $client = static::createClient();
        $client->request('GET', $path);

        self::assertStringContainsString($text, $client->getResponse()->getContent());
    }

    public function pages()
    {
        return [
            ['/french/home', 'Interprète et traductrice en français, anglais, russe et ukrainien'],
            ['/french/service', 'Interprète et traductrice en français, anglais, russe et ukrainien'],
            ['/french/experience', 'Interprète et traductrice en français, anglais, russe et ukrainien'],
            ['/french/quote', 'Interprète et traductrice en français, anglais, russe et ukrainien'],
            ['/english/home', 'Interpreter and translator of French, English, Russian and Ukrainian'],
            ['/english/service', 'Interpreter and translator of French, English, Russian and Ukrainian'],
            ['/english/experience', 'Interpreter and translator of French, English, Russian and Ukrainian'],
            ['/english/quote', 'Interpreter and translator of French, English, Russian and Ukrainian'],
            ['/russian/home', 'Устный и письменный переводчик француского, английского, русского и украинского языков'],
            ['/russian/service', 'Устный и письменный переводчик француского, английского, русского и украинского языков'],
            ['/russian/experience', 'Устный и письменный переводчик француского, английского, русского и украинского языков'],
            ['/russian/quote', 'Устный и письменный переводчик француского, английского, русского и украинского языков'],
            ['/ukrainian/home', 'Усний та письмовий перекладач французької, англійської, російської та української мов'],
            ['/ukrainian/service', 'Усний та письмовий перекладач французької, англійської, російської та української мов'],
            ['/ukrainian/experience', 'Усний та письмовий перекладач французької, англійської, російської та української мов'],
            ['/ukrainian/quote', 'Усний та письмовий перекладач французької, англійської, російської та української мов'],
        ];
    }
}
