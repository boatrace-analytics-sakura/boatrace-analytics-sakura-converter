<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project\Tests;

use Boatrace\Venture\Project\Converter;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * @author shimomo
 */
class ConverterTest extends PHPUnitTestCase
{
    /**
     * @return void
     */
    public function testString(): void
    {
        $this->assertSame('', Converter::string(' '));
        $this->assertSame('', Converter::string('　'));
        $this->assertSame('1', Converter::string('1'));
        $this->assertSame('1', Converter::string('１'));
        $this->assertNull(Converter::string(null));
    }

    /**
     * @return void
     */
    public function testInt(): void
    {
        $this->assertSame(1, Converter::int('1'));
        $this->assertSame(1, Converter::int('１'));
        $this->assertNull(Converter::int(null));
    }

    /**
     * @return void
     */
    public function testFloat(): void
    {
        $this->assertSame(1.0, Converter::float('1.0'));
        $this->assertSame(1.0, Converter::float('１.０'));
        $this->assertNull(Converter::float(null));
    }

    /**
     * @return void
     */
    public function testName(): void
    {
        $this->assertSame('中辻 博訓', Converter::name('中辻 博訓'));
        $this->assertSame('中辻 博訓', Converter::name('中辻　博訓'));
        $this->assertNull(Converter::name(null));
    }

    /**
     * @return void
     */
    public function testFlying(): void
    {
        $this->assertSame(1, Converter::flying('F1'));
        $this->assertSame(1, Converter::flying('F１'));
        $this->assertNull(Converter::flying(null));
    }

    /**
     * @return void
     */
    public function testLate(): void
    {
        $this->assertSame(1, Converter::late('L1'));
        $this->assertSame(1, Converter::late('L１'));
        $this->assertNull(Converter::late(null));
    }

    /**
     * @return void
     */
    public function testStartTiming(): void
    {
        $this->assertSame(0.10, Converter::startTiming('.10'));
        $this->assertSame(0.10, Converter::startTiming('.１０'));
        $this->assertSame(1.0, Converter::startTiming('L'));
        $this->assertSame(-1.0, Converter::startTiming('F'));
        $this->assertNull(Converter::startTiming(null));
    }

    /**
     * @return void
     */
    public function testWind(): void
    {
        $this->assertSame(1, Converter::wind('1m'));
        $this->assertSame(1, Converter::wind('１m'));
        $this->assertNull(Converter::wind(null));
    }

    /**
     * @return void
     */
    public function testWave(): void
    {
        $this->assertSame(1, Converter::wave('1cm'));
        $this->assertSame(1, Converter::wave('１cm'));
        $this->assertNull(Converter::wave(null));
    }

    /**
     * @return void
     */
    public function testTemperature(): void
    {
        $this->assertSame(1.0, Converter::temperature('1.0℃'));
        $this->assertSame(1.0, Converter::temperature('１.０℃'));
        $this->assertNull(Converter::temperature(null));
    }

    /**
     * @return void
     */
    public function testDirection(): void
    {
        $this->assertSame(11, Converter::direction('weather1_bodyUnitImage is-wind11'));
        $this->assertNull(Converter::direction(null));
    }

    /**
     * @return void
     */
    public function testDate(): void
    {
        $this->assertSame('2019-07-01', Converter::date('20190701'));
        $this->assertNull(Converter::date(null));
    }

    /**
     * @return void
     */
    public function testDateTime(): void
    {
        $this->assertSame('2019-07-01 12:30:00', Converter::dateTime('20190701 123000'));
        $this->assertNull(Converter::dateTime(null));
    }

    /**
     * @return void
     */
    public function testClassIdByShortName(): void
    {
        $this->assertSame(1, Converter::classIdByShortName('A1'));
        $this->assertSame(1, Converter::classIdByShortName('A１'));
        $this->assertSame(2, Converter::classIdByShortName('A2'));
        $this->assertSame(2, Converter::classIdByShortName('A２'));
        $this->assertSame(3, Converter::classIdByShortName('B1'));
        $this->assertSame(3, Converter::classIdByShortName('B１'));
        $this->assertSame(4, Converter::classIdByShortName('B2'));
        $this->assertSame(4, Converter::classIdByShortName('B２'));
        $this->assertNull(Converter::classIdByShortName('競艇'));
        $this->assertNull(Converter::classIdByShortName(null));
    }

    /**
     * @return void
     */
    public function testClassShortNameById(): void
    {
        $this->assertSame('A1', Converter::classShortNameById(1));
        $this->assertSame('A2', Converter::classShortNameById(2));
        $this->assertSame('B1', Converter::classShortNameById(3));
        $this->assertSame('B2', Converter::classShortNameById(4));
        $this->assertNull(Converter::classShortNameById(5));
        $this->assertNull(Converter::classShortNameById(null));
    }

    /**
     * @return void
     */
    public function testPlaceIdByShortName(): void
    {
        $this->assertSame(1, Converter::placeIdByShortName('1'));
        $this->assertSame(1, Converter::placeIdByShortName('１'));
        $this->assertSame(2, Converter::placeIdByShortName('2'));
        $this->assertSame(2, Converter::placeIdByShortName('２'));
        $this->assertSame(3, Converter::placeIdByShortName('3'));
        $this->assertSame(3, Converter::placeIdByShortName('３'));
        $this->assertSame(4, Converter::placeIdByShortName('4'));
        $this->assertSame(4, Converter::placeIdByShortName('４'));
        $this->assertSame(5, Converter::placeIdByShortName('5'));
        $this->assertSame(5, Converter::placeIdByShortName('５'));
        $this->assertSame(6, Converter::placeIdByShortName('6'));
        $this->assertSame(6, Converter::placeIdByShortName('６'));
        $this->assertSame(7, Converter::placeIdByShortName('妨'));
        $this->assertSame(8, Converter::placeIdByShortName('エ'));
        $this->assertSame(9, Converter::placeIdByShortName('転'));
        $this->assertSame(10, Converter::placeIdByShortName('落'));
        $this->assertSame(11, Converter::placeIdByShortName('沈'));
        $this->assertSame(12, Converter::placeIdByShortName('不'));
        $this->assertSame(13, Converter::placeIdByShortName('失'));
        $this->assertSame(14, Converter::placeIdByShortName('F'));
        $this->assertSame(15, Converter::placeIdByShortName('L'));
        $this->assertSame(16, Converter::placeIdByShortName('欠'));
        $this->assertNull(Converter::placeIdByShortName('競艇'));
        $this->assertNull(Converter::placeIdByShortName(null));
    }

    /**
     * @return void
     */
    public function testPlaceShortNameById(): void
    {
        $this->assertSame('1', Converter::placeShortNameById(1));
        $this->assertSame('2', Converter::placeShortNameById(2));
        $this->assertSame('3', Converter::placeShortNameById(3));
        $this->assertSame('4', Converter::placeShortNameById(4));
        $this->assertSame('5', Converter::placeShortNameById(5));
        $this->assertSame('6', Converter::placeShortNameById(6));
        $this->assertSame('妨', Converter::placeShortNameById(7));
        $this->assertSame('エ', Converter::placeShortNameById(8));
        $this->assertSame('転', Converter::placeShortNameById(9));
        $this->assertSame('落', Converter::placeShortNameById(10));
        $this->assertSame('沈', Converter::placeShortNameById(11));
        $this->assertSame('不', Converter::placeShortNameById(12));
        $this->assertSame('失', Converter::placeShortNameById(13));
        $this->assertSame('F', Converter::placeShortNameById(14));
        $this->assertSame('L', Converter::placeShortNameById(15));
        $this->assertSame('欠', Converter::placeShortNameById(16));
        $this->assertNull(Converter::placeShortNameById(17));
        $this->assertNull(Converter::placeShortNameById(null));
    }

    /**
     * @return void
     */
    public function testTechniqueIdByName(): void
    {
        $this->assertSame(1, Converter::techniqueIdByName('逃げ'));
        $this->assertSame(2, Converter::techniqueIdByName('差し'));
        $this->assertSame(3, Converter::techniqueIdByName('まくり'));
        $this->assertSame(4, Converter::techniqueIdByName('まくり差し'));
        $this->assertSame(5, Converter::techniqueIdByName('抜き'));
        $this->assertSame(6, Converter::techniqueIdByName('恵まれ'));
        $this->assertNull(Converter::techniqueIdByName('競艇'));
        $this->assertNull(Converter::techniqueIdByName(null));
    }

    /**
     * @return void
     */
    public function testTechniqueNameById(): void
    {
        $this->assertSame('逃げ', Converter::techniqueNameById(1));
        $this->assertSame('差し', Converter::techniqueNameById(2));
        $this->assertSame('まくり', Converter::techniqueNameById(3));
        $this->assertSame('まくり差し', Converter::techniqueNameById(4));
        $this->assertSame('抜き', Converter::techniqueNameById(5));
        $this->assertSame('恵まれ', Converter::techniqueNameById(6));
        $this->assertNull(Converter::techniqueNameById(7));
        $this->assertNull(Converter::techniqueNameById(null));
    }

    /**
     * @return void
     */
    public function testWeatherIdByName(): void
    {
        $this->assertSame(1, Converter::weatherIdByName('晴'));
        $this->assertSame(2, Converter::weatherIdByName('曇り'));
        $this->assertSame(3, Converter::weatherIdByName('雨'));
        $this->assertSame(4, Converter::weatherIdByName('雪'));
        $this->assertSame(5, Converter::weatherIdByName('霧'));
        $this->assertNull(Converter::weatherIdByName('競艇'));
        $this->assertNull(Converter::weatherIdByName(null));
    }

    /**
     * @return void
     */
    public function testWeatherNameById(): void
    {
        $this->assertSame('晴', Converter::weatherNameById(1));
        $this->assertSame('曇り', Converter::weatherNameById(2));
        $this->assertSame('雨', Converter::weatherNameById(3));
        $this->assertSame('雪', Converter::weatherNameById(4));
        $this->assertSame('霧', Converter::weatherNameById(5));
        $this->assertNull(Converter::weatherNameById(6));
        $this->assertNull(Converter::weatherNameById(null));
    }

    /**
     * @return void
     */
    public function testDirectionShortNameById(): void
    {
        $this->assertSame('↑', Converter::directionShortNameById(1));
        $this->assertSame('↑', Converter::directionShortNameById(2));
        $this->assertSame('↗', Converter::directionShortNameById(3));
        $this->assertSame('→', Converter::directionShortNameById(4));
        $this->assertSame('→', Converter::directionShortNameById(5));
        $this->assertSame('→', Converter::directionShortNameById(6));
        $this->assertSame('↘', Converter::directionShortNameById(7));
        $this->assertSame('↓', Converter::directionShortNameById(8));
        $this->assertSame('↓', Converter::directionShortNameById(9));
        $this->assertSame('↓', Converter::directionShortNameById(10));
        $this->assertSame('↙', Converter::directionShortNameById(11));
        $this->assertSame('←', Converter::directionShortNameById(12));
        $this->assertSame('←', Converter::directionShortNameById(13));
        $this->assertSame('←', Converter::directionShortNameById(14));
        $this->assertSame('↖', Converter::directionShortNameById(15));
        $this->assertSame('↑', Converter::directionShortNameById(16));
        $this->assertSame('', Converter::directionShortNameById(17));
        $this->assertNull(Converter::directionShortNameById(18));
        $this->assertNull(Converter::directionShortNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureIdByName(): void
    {
        $this->assertSame(1, Converter::prefectureIdByName('北海道'));
        $this->assertSame(2, Converter::prefectureIdByName('青森県'));
        $this->assertSame(3, Converter::prefectureIdByName('岩手県'));
        $this->assertSame(4, Converter::prefectureIdByName('宮城県'));
        $this->assertSame(5, Converter::prefectureIdByName('秋田県'));
        $this->assertSame(6, Converter::prefectureIdByName('山形県'));
        $this->assertSame(7, Converter::prefectureIdByName('福島県'));
        $this->assertSame(8, Converter::prefectureIdByName('茨城県'));
        $this->assertSame(9, Converter::prefectureIdByName('栃木県'));
        $this->assertSame(10, Converter::prefectureIdByName('群馬県'));
        $this->assertSame(11, Converter::prefectureIdByName('埼玉県'));
        $this->assertSame(12, Converter::prefectureIdByName('千葉県'));
        $this->assertSame(13, Converter::prefectureIdByName('東京都'));
        $this->assertSame(14, Converter::prefectureIdByName('神奈川県'));
        $this->assertSame(15, Converter::prefectureIdByName('新潟県'));
        $this->assertSame(16, Converter::prefectureIdByName('富山県'));
        $this->assertSame(17, Converter::prefectureIdByName('石川県'));
        $this->assertSame(18, Converter::prefectureIdByName('福井県'));
        $this->assertSame(19, Converter::prefectureIdByName('山梨県'));
        $this->assertSame(20, Converter::prefectureIdByName('長野県'));
        $this->assertSame(21, Converter::prefectureIdByName('岐阜県'));
        $this->assertSame(22, Converter::prefectureIdByName('静岡県'));
        $this->assertSame(23, Converter::prefectureIdByName('愛知県'));
        $this->assertSame(24, Converter::prefectureIdByName('三重県'));
        $this->assertSame(25, Converter::prefectureIdByName('滋賀県'));
        $this->assertSame(26, Converter::prefectureIdByName('京都府'));
        $this->assertSame(27, Converter::prefectureIdByName('大阪府'));
        $this->assertSame(28, Converter::prefectureIdByName('兵庫県'));
        $this->assertSame(29, Converter::prefectureIdByName('奈良県'));
        $this->assertSame(30, Converter::prefectureIdByName('和歌山県'));
        $this->assertSame(31, Converter::prefectureIdByName('鳥取県'));
        $this->assertSame(32, Converter::prefectureIdByName('島根県'));
        $this->assertSame(33, Converter::prefectureIdByName('岡山県'));
        $this->assertSame(34, Converter::prefectureIdByName('広島県'));
        $this->assertSame(35, Converter::prefectureIdByName('山口県'));
        $this->assertSame(36, Converter::prefectureIdByName('徳島県'));
        $this->assertSame(37, Converter::prefectureIdByName('香川県'));
        $this->assertSame(38, Converter::prefectureIdByName('愛媛県'));
        $this->assertSame(39, Converter::prefectureIdByName('高知県'));
        $this->assertSame(40, Converter::prefectureIdByName('福岡県'));
        $this->assertSame(41, Converter::prefectureIdByName('佐賀県'));
        $this->assertSame(42, Converter::prefectureIdByName('長崎県'));
        $this->assertSame(43, Converter::prefectureIdByName('熊本県'));
        $this->assertSame(44, Converter::prefectureIdByName('大分県'));
        $this->assertSame(45, Converter::prefectureIdByName('宮崎県'));
        $this->assertSame(46, Converter::prefectureIdByName('鹿児島県'));
        $this->assertSame(47, Converter::prefectureIdByName('沖縄県'));
        $this->assertNull(Converter::prefectureIdByName('競艇'));
        $this->assertNull(Converter::prefectureIdByName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureIdByShortName(): void
    {
        $this->assertSame(1, Converter::prefectureIdByShortName('北海道'));
        $this->assertSame(2, Converter::prefectureIdByShortName('青森'));
        $this->assertSame(3, Converter::prefectureIdByShortName('岩手'));
        $this->assertSame(4, Converter::prefectureIdByShortName('宮城'));
        $this->assertSame(5, Converter::prefectureIdByShortName('秋田'));
        $this->assertSame(6, Converter::prefectureIdByShortName('山形'));
        $this->assertSame(7, Converter::prefectureIdByShortName('福島'));
        $this->assertSame(8, Converter::prefectureIdByShortName('茨城'));
        $this->assertSame(9, Converter::prefectureIdByShortName('栃木'));
        $this->assertSame(10, Converter::prefectureIdByShortName('群馬'));
        $this->assertSame(11, Converter::prefectureIdByShortName('埼玉'));
        $this->assertSame(12, Converter::prefectureIdByShortName('千葉'));
        $this->assertSame(13, Converter::prefectureIdByShortName('東京'));
        $this->assertSame(14, Converter::prefectureIdByShortName('神奈川'));
        $this->assertSame(15, Converter::prefectureIdByShortName('新潟'));
        $this->assertSame(16, Converter::prefectureIdByShortName('富山'));
        $this->assertSame(17, Converter::prefectureIdByShortName('石川'));
        $this->assertSame(18, Converter::prefectureIdByShortName('福井'));
        $this->assertSame(19, Converter::prefectureIdByShortName('山梨'));
        $this->assertSame(20, Converter::prefectureIdByShortName('長野'));
        $this->assertSame(21, Converter::prefectureIdByShortName('岐阜'));
        $this->assertSame(22, Converter::prefectureIdByShortName('静岡'));
        $this->assertSame(23, Converter::prefectureIdByShortName('愛知'));
        $this->assertSame(24, Converter::prefectureIdByShortName('三重'));
        $this->assertSame(25, Converter::prefectureIdByShortName('滋賀'));
        $this->assertSame(26, Converter::prefectureIdByShortName('京都'));
        $this->assertSame(27, Converter::prefectureIdByShortName('大阪'));
        $this->assertSame(28, Converter::prefectureIdByShortName('兵庫'));
        $this->assertSame(29, Converter::prefectureIdByShortName('奈良'));
        $this->assertSame(30, Converter::prefectureIdByShortName('和歌山'));
        $this->assertSame(31, Converter::prefectureIdByShortName('鳥取'));
        $this->assertSame(32, Converter::prefectureIdByShortName('島根'));
        $this->assertSame(33, Converter::prefectureIdByShortName('岡山'));
        $this->assertSame(34, Converter::prefectureIdByShortName('広島'));
        $this->assertSame(35, Converter::prefectureIdByShortName('山口'));
        $this->assertSame(36, Converter::prefectureIdByShortName('徳島'));
        $this->assertSame(37, Converter::prefectureIdByShortName('香川'));
        $this->assertSame(38, Converter::prefectureIdByShortName('愛媛'));
        $this->assertSame(39, Converter::prefectureIdByShortName('高知'));
        $this->assertSame(40, Converter::prefectureIdByShortName('福岡'));
        $this->assertSame(41, Converter::prefectureIdByShortName('佐賀'));
        $this->assertSame(42, Converter::prefectureIdByShortName('長崎'));
        $this->assertSame(43, Converter::prefectureIdByShortName('熊本'));
        $this->assertSame(44, Converter::prefectureIdByShortName('大分'));
        $this->assertSame(45, Converter::prefectureIdByShortName('宮崎'));
        $this->assertSame(46, Converter::prefectureIdByShortName('鹿児島'));
        $this->assertSame(47, Converter::prefectureIdByShortName('沖縄'));
        $this->assertNull(Converter::prefectureIdByShortName('競艇'));
        $this->assertNull(Converter::prefectureIdByShortName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureIdByHiraganaName(): void
    {
        $this->assertSame(1, Converter::prefectureIdByHiraganaName('ほっかいどう'));
        $this->assertSame(2, Converter::prefectureIdByHiraganaName('あおもりけん'));
        $this->assertSame(3, Converter::prefectureIdByHiraganaName('いわてけん'));
        $this->assertSame(4, Converter::prefectureIdByHiraganaName('みやぎけん'));
        $this->assertSame(5, Converter::prefectureIdByHiraganaName('あきたけん'));
        $this->assertSame(6, Converter::prefectureIdByHiraganaName('やまがたけん'));
        $this->assertSame(7, Converter::prefectureIdByHiraganaName('ふくしまけん'));
        $this->assertSame(8, Converter::prefectureIdByHiraganaName('いばらきけん'));
        $this->assertSame(9, Converter::prefectureIdByHiraganaName('とちぎけん'));
        $this->assertSame(10, Converter::prefectureIdByHiraganaName('ぐんまけん'));
        $this->assertSame(11, Converter::prefectureIdByHiraganaName('さいたまけん'));
        $this->assertSame(12, Converter::prefectureIdByHiraganaName('ちばけん'));
        $this->assertSame(13, Converter::prefectureIdByHiraganaName('とうきょうと'));
        $this->assertSame(14, Converter::prefectureIdByHiraganaName('かながわけん'));
        $this->assertSame(15, Converter::prefectureIdByHiraganaName('にいがたけん'));
        $this->assertSame(16, Converter::prefectureIdByHiraganaName('とやまけん'));
        $this->assertSame(17, Converter::prefectureIdByHiraganaName('いしかわけん'));
        $this->assertSame(18, Converter::prefectureIdByHiraganaName('ふくいけん'));
        $this->assertSame(19, Converter::prefectureIdByHiraganaName('やまなしけん'));
        $this->assertSame(20, Converter::prefectureIdByHiraganaName('ながのけん'));
        $this->assertSame(21, Converter::prefectureIdByHiraganaName('ぎふけん'));
        $this->assertSame(22, Converter::prefectureIdByHiraganaName('しずおかけん'));
        $this->assertSame(23, Converter::prefectureIdByHiraganaName('あいちけん'));
        $this->assertSame(24, Converter::prefectureIdByHiraganaName('みえけん'));
        $this->assertSame(25, Converter::prefectureIdByHiraganaName('しがけん'));
        $this->assertSame(26, Converter::prefectureIdByHiraganaName('きょうとふ'));
        $this->assertSame(27, Converter::prefectureIdByHiraganaName('おおさかふ'));
        $this->assertSame(28, Converter::prefectureIdByHiraganaName('ひょうごけん'));
        $this->assertSame(29, Converter::prefectureIdByHiraganaName('ならけん'));
        $this->assertSame(30, Converter::prefectureIdByHiraganaName('わかやまけん'));
        $this->assertSame(31, Converter::prefectureIdByHiraganaName('とっとりけん'));
        $this->assertSame(32, Converter::prefectureIdByHiraganaName('しまねけん'));
        $this->assertSame(33, Converter::prefectureIdByHiraganaName('おかやまけん'));
        $this->assertSame(34, Converter::prefectureIdByHiraganaName('ひろしまけん'));
        $this->assertSame(35, Converter::prefectureIdByHiraganaName('やまぐちけん'));
        $this->assertSame(36, Converter::prefectureIdByHiraganaName('とくしまけん'));
        $this->assertSame(37, Converter::prefectureIdByHiraganaName('かがわけん'));
        $this->assertSame(38, Converter::prefectureIdByHiraganaName('えひめけん'));
        $this->assertSame(39, Converter::prefectureIdByHiraganaName('こうちけん'));
        $this->assertSame(40, Converter::prefectureIdByHiraganaName('ふくおかけん'));
        $this->assertSame(41, Converter::prefectureIdByHiraganaName('さがけん'));
        $this->assertSame(42, Converter::prefectureIdByHiraganaName('ながさきけん'));
        $this->assertSame(43, Converter::prefectureIdByHiraganaName('くまもとけん'));
        $this->assertSame(44, Converter::prefectureIdByHiraganaName('おおいたけん'));
        $this->assertSame(45, Converter::prefectureIdByHiraganaName('みやざきけん'));
        $this->assertSame(46, Converter::prefectureIdByHiraganaName('かごしまけん'));
        $this->assertSame(47, Converter::prefectureIdByHiraganaName('おきなわけん'));
        $this->assertNull(Converter::prefectureIdByHiraganaName('きょうてい'));
        $this->assertNull(Converter::prefectureIdByHiraganaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureIdByKatakanaName(): void
    {
        $this->assertSame(1, Converter::prefectureIdByKatakanaName('ホッカイドウ'));
        $this->assertSame(2, Converter::prefectureIdByKatakanaName('アオモリケン'));
        $this->assertSame(3, Converter::prefectureIdByKatakanaName('イワテケン'));
        $this->assertSame(4, Converter::prefectureIdByKatakanaName('ミヤギケン'));
        $this->assertSame(5, Converter::prefectureIdByKatakanaName('アキタケン'));
        $this->assertSame(6, Converter::prefectureIdByKatakanaName('ヤマガタケン'));
        $this->assertSame(7, Converter::prefectureIdByKatakanaName('フクシマケン'));
        $this->assertSame(8, Converter::prefectureIdByKatakanaName('イバラキケン'));
        $this->assertSame(9, Converter::prefectureIdByKatakanaName('トチギケン'));
        $this->assertSame(10, Converter::prefectureIdByKatakanaName('グンマケン'));
        $this->assertSame(11, Converter::prefectureIdByKatakanaName('サイタマケン'));
        $this->assertSame(12, Converter::prefectureIdByKatakanaName('チバケン'));
        $this->assertSame(13, Converter::prefectureIdByKatakanaName('トウキョウト'));
        $this->assertSame(14, Converter::prefectureIdByKatakanaName('カナガワケン'));
        $this->assertSame(15, Converter::prefectureIdByKatakanaName('ニイガタケン'));
        $this->assertSame(16, Converter::prefectureIdByKatakanaName('トヤマケン'));
        $this->assertSame(17, Converter::prefectureIdByKatakanaName('イシカワケン'));
        $this->assertSame(18, Converter::prefectureIdByKatakanaName('フクイケン'));
        $this->assertSame(19, Converter::prefectureIdByKatakanaName('ヤマナシケン'));
        $this->assertSame(20, Converter::prefectureIdByKatakanaName('ナガノケン'));
        $this->assertSame(21, Converter::prefectureIdByKatakanaName('ギフケン'));
        $this->assertSame(22, Converter::prefectureIdByKatakanaName('シズオカケン'));
        $this->assertSame(23, Converter::prefectureIdByKatakanaName('アイチケン'));
        $this->assertSame(24, Converter::prefectureIdByKatakanaName('ミエケン'));
        $this->assertSame(25, Converter::prefectureIdByKatakanaName('シガケン'));
        $this->assertSame(26, Converter::prefectureIdByKatakanaName('キョウトフ'));
        $this->assertSame(27, Converter::prefectureIdByKatakanaName('オオサカフ'));
        $this->assertSame(28, Converter::prefectureIdByKatakanaName('ヒョウゴケン'));
        $this->assertSame(29, Converter::prefectureIdByKatakanaName('ナラケン'));
        $this->assertSame(30, Converter::prefectureIdByKatakanaName('ワカヤマケン'));
        $this->assertSame(31, Converter::prefectureIdByKatakanaName('トットリケン'));
        $this->assertSame(32, Converter::prefectureIdByKatakanaName('シマネケン'));
        $this->assertSame(33, Converter::prefectureIdByKatakanaName('オカヤマケン'));
        $this->assertSame(34, Converter::prefectureIdByKatakanaName('ヒロシマケン'));
        $this->assertSame(35, Converter::prefectureIdByKatakanaName('ヤマグチケン'));
        $this->assertSame(36, Converter::prefectureIdByKatakanaName('トクシマケン'));
        $this->assertSame(37, Converter::prefectureIdByKatakanaName('カガワケン'));
        $this->assertSame(38, Converter::prefectureIdByKatakanaName('エヒメケン'));
        $this->assertSame(39, Converter::prefectureIdByKatakanaName('コウチケン'));
        $this->assertSame(40, Converter::prefectureIdByKatakanaName('フクオカケン'));
        $this->assertSame(41, Converter::prefectureIdByKatakanaName('サガケン'));
        $this->assertSame(42, Converter::prefectureIdByKatakanaName('ナガサキケン'));
        $this->assertSame(43, Converter::prefectureIdByKatakanaName('クマモトケン'));
        $this->assertSame(44, Converter::prefectureIdByKatakanaName('オオイタケン'));
        $this->assertSame(45, Converter::prefectureIdByKatakanaName('ミヤザキケン'));
        $this->assertSame(46, Converter::prefectureIdByKatakanaName('カゴシマケン'));
        $this->assertSame(47, Converter::prefectureIdByKatakanaName('オキナワケン'));
        $this->assertNull(Converter::prefectureIdByKatakanaName('キョウテイ'));
        $this->assertNull(Converter::prefectureIdByKatakanaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureIdByEnglishName(): void
    {
        $this->assertSame(1, Converter::prefectureIdByEnglishName('hokkaido'));
        $this->assertSame(2, Converter::prefectureIdByEnglishName('aomori'));
        $this->assertSame(3, Converter::prefectureIdByEnglishName('iwate'));
        $this->assertSame(4, Converter::prefectureIdByEnglishName('miyagi'));
        $this->assertSame(5, Converter::prefectureIdByEnglishName('akita'));
        $this->assertSame(6, Converter::prefectureIdByEnglishName('yamagata'));
        $this->assertSame(7, Converter::prefectureIdByEnglishName('fukushima'));
        $this->assertSame(8, Converter::prefectureIdByEnglishName('ibaraki'));
        $this->assertSame(9, Converter::prefectureIdByEnglishName('tochigi'));
        $this->assertSame(10, Converter::prefectureIdByEnglishName('gunma'));
        $this->assertSame(11, Converter::prefectureIdByEnglishName('saitama'));
        $this->assertSame(12, Converter::prefectureIdByEnglishName('chiba'));
        $this->assertSame(13, Converter::prefectureIdByEnglishName('tokyo'));
        $this->assertSame(14, Converter::prefectureIdByEnglishName('kanagawa'));
        $this->assertSame(15, Converter::prefectureIdByEnglishName('niigata'));
        $this->assertSame(16, Converter::prefectureIdByEnglishName('toyama'));
        $this->assertSame(17, Converter::prefectureIdByEnglishName('ishikawa'));
        $this->assertSame(18, Converter::prefectureIdByEnglishName('fukui'));
        $this->assertSame(19, Converter::prefectureIdByEnglishName('yamanashi'));
        $this->assertSame(20, Converter::prefectureIdByEnglishName('nagano'));
        $this->assertSame(21, Converter::prefectureIdByEnglishName('gifu'));
        $this->assertSame(22, Converter::prefectureIdByEnglishName('shizuoka'));
        $this->assertSame(23, Converter::prefectureIdByEnglishName('aichi'));
        $this->assertSame(24, Converter::prefectureIdByEnglishName('mie'));
        $this->assertSame(25, Converter::prefectureIdByEnglishName('shiga'));
        $this->assertSame(26, Converter::prefectureIdByEnglishName('kyoto'));
        $this->assertSame(27, Converter::prefectureIdByEnglishName('osaka'));
        $this->assertSame(28, Converter::prefectureIdByEnglishName('hyogo'));
        $this->assertSame(29, Converter::prefectureIdByEnglishName('nara'));
        $this->assertSame(30, Converter::prefectureIdByEnglishName('wakayama'));
        $this->assertSame(31, Converter::prefectureIdByEnglishName('tottori'));
        $this->assertSame(32, Converter::prefectureIdByEnglishName('shimane'));
        $this->assertSame(33, Converter::prefectureIdByEnglishName('okayama'));
        $this->assertSame(34, Converter::prefectureIdByEnglishName('hiroshima'));
        $this->assertSame(35, Converter::prefectureIdByEnglishName('yamaguchi'));
        $this->assertSame(36, Converter::prefectureIdByEnglishName('tokushima'));
        $this->assertSame(37, Converter::prefectureIdByEnglishName('kagawa'));
        $this->assertSame(38, Converter::prefectureIdByEnglishName('ehime'));
        $this->assertSame(39, Converter::prefectureIdByEnglishName('kochi'));
        $this->assertSame(40, Converter::prefectureIdByEnglishName('fukuoka'));
        $this->assertSame(41, Converter::prefectureIdByEnglishName('saga'));
        $this->assertSame(42, Converter::prefectureIdByEnglishName('nagasaki'));
        $this->assertSame(43, Converter::prefectureIdByEnglishName('kumamoto'));
        $this->assertSame(44, Converter::prefectureIdByEnglishName('oita'));
        $this->assertSame(45, Converter::prefectureIdByEnglishName('miyazaki'));
        $this->assertSame(46, Converter::prefectureIdByEnglishName('kagoshima'));
        $this->assertSame(47, Converter::prefectureIdByEnglishName('okinawa'));
        $this->assertNull(Converter::prefectureIdByEnglishName('kyotei'));
        $this->assertNull(Converter::prefectureIdByEnglishName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureNameById(): void
    {
        $this->assertSame('北海道', Converter::prefectureNameById(1));
        $this->assertSame('青森県', Converter::prefectureNameById(2));
        $this->assertSame('岩手県', Converter::prefectureNameById(3));
        $this->assertSame('宮城県', Converter::prefectureNameById(4));
        $this->assertSame('秋田県', Converter::prefectureNameById(5));
        $this->assertSame('山形県', Converter::prefectureNameById(6));
        $this->assertSame('福島県', Converter::prefectureNameById(7));
        $this->assertSame('茨城県', Converter::prefectureNameById(8));
        $this->assertSame('栃木県', Converter::prefectureNameById(9));
        $this->assertSame('群馬県', Converter::prefectureNameById(10));
        $this->assertSame('埼玉県', Converter::prefectureNameById(11));
        $this->assertSame('千葉県', Converter::prefectureNameById(12));
        $this->assertSame('東京都', Converter::prefectureNameById(13));
        $this->assertSame('神奈川県', Converter::prefectureNameById(14));
        $this->assertSame('新潟県', Converter::prefectureNameById(15));
        $this->assertSame('富山県', Converter::prefectureNameById(16));
        $this->assertSame('石川県', Converter::prefectureNameById(17));
        $this->assertSame('福井県', Converter::prefectureNameById(18));
        $this->assertSame('山梨県', Converter::prefectureNameById(19));
        $this->assertSame('長野県', Converter::prefectureNameById(20));
        $this->assertSame('岐阜県', Converter::prefectureNameById(21));
        $this->assertSame('静岡県', Converter::prefectureNameById(22));
        $this->assertSame('愛知県', Converter::prefectureNameById(23));
        $this->assertSame('三重県', Converter::prefectureNameById(24));
        $this->assertSame('滋賀県', Converter::prefectureNameById(25));
        $this->assertSame('京都府', Converter::prefectureNameById(26));
        $this->assertSame('大阪府', Converter::prefectureNameById(27));
        $this->assertSame('兵庫県', Converter::prefectureNameById(28));
        $this->assertSame('奈良県', Converter::prefectureNameById(29));
        $this->assertSame('和歌山県', Converter::prefectureNameById(30));
        $this->assertSame('鳥取県', Converter::prefectureNameById(31));
        $this->assertSame('島根県', Converter::prefectureNameById(32));
        $this->assertSame('岡山県', Converter::prefectureNameById(33));
        $this->assertSame('広島県', Converter::prefectureNameById(34));
        $this->assertSame('山口県', Converter::prefectureNameById(35));
        $this->assertSame('徳島県', Converter::prefectureNameById(36));
        $this->assertSame('香川県', Converter::prefectureNameById(37));
        $this->assertSame('愛媛県', Converter::prefectureNameById(38));
        $this->assertSame('高知県', Converter::prefectureNameById(39));
        $this->assertSame('福岡県', Converter::prefectureNameById(40));
        $this->assertSame('佐賀県', Converter::prefectureNameById(41));
        $this->assertSame('長崎県', Converter::prefectureNameById(42));
        $this->assertSame('熊本県', Converter::prefectureNameById(43));
        $this->assertSame('大分県', Converter::prefectureNameById(44));
        $this->assertSame('宮崎県', Converter::prefectureNameById(45));
        $this->assertSame('鹿児島県', Converter::prefectureNameById(46));
        $this->assertSame('沖縄県', Converter::prefectureNameById(47));
        $this->assertNull(Converter::prefectureNameById(48));
        $this->assertNull(Converter::prefectureNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureNameByShortName(): void
    {
        $this->assertSame('北海道', Converter::prefectureNameByShortName('北海道'));
        $this->assertSame('青森県', Converter::prefectureNameByShortName('青森'));
        $this->assertSame('岩手県', Converter::prefectureNameByShortName('岩手'));
        $this->assertSame('宮城県', Converter::prefectureNameByShortName('宮城'));
        $this->assertSame('秋田県', Converter::prefectureNameByShortName('秋田'));
        $this->assertSame('山形県', Converter::prefectureNameByShortName('山形'));
        $this->assertSame('福島県', Converter::prefectureNameByShortName('福島'));
        $this->assertSame('茨城県', Converter::prefectureNameByShortName('茨城'));
        $this->assertSame('栃木県', Converter::prefectureNameByShortName('栃木'));
        $this->assertSame('群馬県', Converter::prefectureNameByShortName('群馬'));
        $this->assertSame('埼玉県', Converter::prefectureNameByShortName('埼玉'));
        $this->assertSame('千葉県', Converter::prefectureNameByShortName('千葉'));
        $this->assertSame('東京都', Converter::prefectureNameByShortName('東京'));
        $this->assertSame('神奈川県', Converter::prefectureNameByShortName('神奈川'));
        $this->assertSame('新潟県', Converter::prefectureNameByShortName('新潟'));
        $this->assertSame('富山県', Converter::prefectureNameByShortName('富山'));
        $this->assertSame('石川県', Converter::prefectureNameByShortName('石川'));
        $this->assertSame('福井県', Converter::prefectureNameByShortName('福井'));
        $this->assertSame('山梨県', Converter::prefectureNameByShortName('山梨'));
        $this->assertSame('長野県', Converter::prefectureNameByShortName('長野'));
        $this->assertSame('岐阜県', Converter::prefectureNameByShortName('岐阜'));
        $this->assertSame('静岡県', Converter::prefectureNameByShortName('静岡'));
        $this->assertSame('愛知県', Converter::prefectureNameByShortName('愛知'));
        $this->assertSame('三重県', Converter::prefectureNameByShortName('三重'));
        $this->assertSame('滋賀県', Converter::prefectureNameByShortName('滋賀'));
        $this->assertSame('京都府', Converter::prefectureNameByShortName('京都'));
        $this->assertSame('大阪府', Converter::prefectureNameByShortName('大阪'));
        $this->assertSame('兵庫県', Converter::prefectureNameByShortName('兵庫'));
        $this->assertSame('奈良県', Converter::prefectureNameByShortName('奈良'));
        $this->assertSame('和歌山県', Converter::prefectureNameByShortName('和歌山'));
        $this->assertSame('鳥取県', Converter::prefectureNameByShortName('鳥取'));
        $this->assertSame('島根県', Converter::prefectureNameByShortName('島根'));
        $this->assertSame('岡山県', Converter::prefectureNameByShortName('岡山'));
        $this->assertSame('広島県', Converter::prefectureNameByShortName('広島'));
        $this->assertSame('山口県', Converter::prefectureNameByShortName('山口'));
        $this->assertSame('徳島県', Converter::prefectureNameByShortName('徳島'));
        $this->assertSame('香川県', Converter::prefectureNameByShortName('香川'));
        $this->assertSame('愛媛県', Converter::prefectureNameByShortName('愛媛'));
        $this->assertSame('高知県', Converter::prefectureNameByShortName('高知'));
        $this->assertSame('福岡県', Converter::prefectureNameByShortName('福岡'));
        $this->assertSame('佐賀県', Converter::prefectureNameByShortName('佐賀'));
        $this->assertSame('長崎県', Converter::prefectureNameByShortName('長崎'));
        $this->assertSame('熊本県', Converter::prefectureNameByShortName('熊本'));
        $this->assertSame('大分県', Converter::prefectureNameByShortName('大分'));
        $this->assertSame('宮崎県', Converter::prefectureNameByShortName('宮崎'));
        $this->assertSame('鹿児島県', Converter::prefectureNameByShortName('鹿児島'));
        $this->assertSame('沖縄県', Converter::prefectureNameByShortName('沖縄'));
        $this->assertNull(Converter::prefectureNameByShortName('競艇'));
        $this->assertNull(Converter::prefectureNameByShortName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureNameByHiraganaName(): void
    {
        $this->assertSame('北海道', Converter::prefectureNameByHiraganaName('ほっかいどう'));
        $this->assertSame('青森県', Converter::prefectureNameByHiraganaName('あおもりけん'));
        $this->assertSame('岩手県', Converter::prefectureNameByHiraganaName('いわてけん'));
        $this->assertSame('宮城県', Converter::prefectureNameByHiraganaName('みやぎけん'));
        $this->assertSame('秋田県', Converter::prefectureNameByHiraganaName('あきたけん'));
        $this->assertSame('山形県', Converter::prefectureNameByHiraganaName('やまがたけん'));
        $this->assertSame('福島県', Converter::prefectureNameByHiraganaName('ふくしまけん'));
        $this->assertSame('茨城県', Converter::prefectureNameByHiraganaName('いばらきけん'));
        $this->assertSame('栃木県', Converter::prefectureNameByHiraganaName('とちぎけん'));
        $this->assertSame('群馬県', Converter::prefectureNameByHiraganaName('ぐんまけん'));
        $this->assertSame('埼玉県', Converter::prefectureNameByHiraganaName('さいたまけん'));
        $this->assertSame('千葉県', Converter::prefectureNameByHiraganaName('ちばけん'));
        $this->assertSame('東京都', Converter::prefectureNameByHiraganaName('とうきょうと'));
        $this->assertSame('神奈川県', Converter::prefectureNameByHiraganaName('かながわけん'));
        $this->assertSame('新潟県', Converter::prefectureNameByHiraganaName('にいがたけん'));
        $this->assertSame('富山県', Converter::prefectureNameByHiraganaName('とやまけん'));
        $this->assertSame('石川県', Converter::prefectureNameByHiraganaName('いしかわけん'));
        $this->assertSame('福井県', Converter::prefectureNameByHiraganaName('ふくいけん'));
        $this->assertSame('山梨県', Converter::prefectureNameByHiraganaName('やまなしけん'));
        $this->assertSame('長野県', Converter::prefectureNameByHiraganaName('ながのけん'));
        $this->assertSame('岐阜県', Converter::prefectureNameByHiraganaName('ぎふけん'));
        $this->assertSame('静岡県', Converter::prefectureNameByHiraganaName('しずおかけん'));
        $this->assertSame('愛知県', Converter::prefectureNameByHiraganaName('あいちけん'));
        $this->assertSame('三重県', Converter::prefectureNameByHiraganaName('みえけん'));
        $this->assertSame('滋賀県', Converter::prefectureNameByHiraganaName('しがけん'));
        $this->assertSame('京都府', Converter::prefectureNameByHiraganaName('きょうとふ'));
        $this->assertSame('大阪府', Converter::prefectureNameByHiraganaName('おおさかふ'));
        $this->assertSame('兵庫県', Converter::prefectureNameByHiraganaName('ひょうごけん'));
        $this->assertSame('奈良県', Converter::prefectureNameByHiraganaName('ならけん'));
        $this->assertSame('和歌山県', Converter::prefectureNameByHiraganaName('わかやまけん'));
        $this->assertSame('鳥取県', Converter::prefectureNameByHiraganaName('とっとりけん'));
        $this->assertSame('島根県', Converter::prefectureNameByHiraganaName('しまねけん'));
        $this->assertSame('岡山県', Converter::prefectureNameByHiraganaName('おかやまけん'));
        $this->assertSame('広島県', Converter::prefectureNameByHiraganaName('ひろしまけん'));
        $this->assertSame('山口県', Converter::prefectureNameByHiraganaName('やまぐちけん'));
        $this->assertSame('徳島県', Converter::prefectureNameByHiraganaName('とくしまけん'));
        $this->assertSame('香川県', Converter::prefectureNameByHiraganaName('かがわけん'));
        $this->assertSame('愛媛県', Converter::prefectureNameByHiraganaName('えひめけん'));
        $this->assertSame('高知県', Converter::prefectureNameByHiraganaName('こうちけん'));
        $this->assertSame('福岡県', Converter::prefectureNameByHiraganaName('ふくおかけん'));
        $this->assertSame('佐賀県', Converter::prefectureNameByHiraganaName('さがけん'));
        $this->assertSame('長崎県', Converter::prefectureNameByHiraganaName('ながさきけん'));
        $this->assertSame('熊本県', Converter::prefectureNameByHiraganaName('くまもとけん'));
        $this->assertSame('大分県', Converter::prefectureNameByHiraganaName('おおいたけん'));
        $this->assertSame('宮崎県', Converter::prefectureNameByHiraganaName('みやざきけん'));
        $this->assertSame('鹿児島県', Converter::prefectureNameByHiraganaName('かごしまけん'));
        $this->assertSame('沖縄県', Converter::prefectureNameByHiraganaName('おきなわけん'));
        $this->assertNull(Converter::prefectureNameByHiraganaName('きょうてい'));
        $this->assertNull(Converter::prefectureNameByHiraganaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureNameByKatakanaName(): void
    {
        $this->assertSame('北海道', Converter::prefectureNameByKatakanaName('ホッカイドウ'));
        $this->assertSame('青森県', Converter::prefectureNameByKatakanaName('アオモリケン'));
        $this->assertSame('岩手県', Converter::prefectureNameByKatakanaName('イワテケン'));
        $this->assertSame('宮城県', Converter::prefectureNameByKatakanaName('ミヤギケン'));
        $this->assertSame('秋田県', Converter::prefectureNameByKatakanaName('アキタケン'));
        $this->assertSame('山形県', Converter::prefectureNameByKatakanaName('ヤマガタケン'));
        $this->assertSame('福島県', Converter::prefectureNameByKatakanaName('フクシマケン'));
        $this->assertSame('茨城県', Converter::prefectureNameByKatakanaName('イバラキケン'));
        $this->assertSame('栃木県', Converter::prefectureNameByKatakanaName('トチギケン'));
        $this->assertSame('群馬県', Converter::prefectureNameByKatakanaName('グンマケン'));
        $this->assertSame('埼玉県', Converter::prefectureNameByKatakanaName('サイタマケン'));
        $this->assertSame('千葉県', Converter::prefectureNameByKatakanaName('チバケン'));
        $this->assertSame('東京都', Converter::prefectureNameByKatakanaName('トウキョウト'));
        $this->assertSame('神奈川県', Converter::prefectureNameByKatakanaName('カナガワケン'));
        $this->assertSame('新潟県', Converter::prefectureNameByKatakanaName('ニイガタケン'));
        $this->assertSame('富山県', Converter::prefectureNameByKatakanaName('トヤマケン'));
        $this->assertSame('石川県', Converter::prefectureNameByKatakanaName('イシカワケン'));
        $this->assertSame('福井県', Converter::prefectureNameByKatakanaName('フクイケン'));
        $this->assertSame('山梨県', Converter::prefectureNameByKatakanaName('ヤマナシケン'));
        $this->assertSame('長野県', Converter::prefectureNameByKatakanaName('ナガノケン'));
        $this->assertSame('岐阜県', Converter::prefectureNameByKatakanaName('ギフケン'));
        $this->assertSame('静岡県', Converter::prefectureNameByKatakanaName('シズオカケン'));
        $this->assertSame('愛知県', Converter::prefectureNameByKatakanaName('アイチケン'));
        $this->assertSame('三重県', Converter::prefectureNameByKatakanaName('ミエケン'));
        $this->assertSame('滋賀県', Converter::prefectureNameByKatakanaName('シガケン'));
        $this->assertSame('京都府', Converter::prefectureNameByKatakanaName('キョウトフ'));
        $this->assertSame('大阪府', Converter::prefectureNameByKatakanaName('オオサカフ'));
        $this->assertSame('兵庫県', Converter::prefectureNameByKatakanaName('ヒョウゴケン'));
        $this->assertSame('奈良県', Converter::prefectureNameByKatakanaName('ナラケン'));
        $this->assertSame('和歌山県', Converter::prefectureNameByKatakanaName('ワカヤマケン'));
        $this->assertSame('鳥取県', Converter::prefectureNameByKatakanaName('トットリケン'));
        $this->assertSame('島根県', Converter::prefectureNameByKatakanaName('シマネケン'));
        $this->assertSame('岡山県', Converter::prefectureNameByKatakanaName('オカヤマケン'));
        $this->assertSame('広島県', Converter::prefectureNameByKatakanaName('ヒロシマケン'));
        $this->assertSame('山口県', Converter::prefectureNameByKatakanaName('ヤマグチケン'));
        $this->assertSame('徳島県', Converter::prefectureNameByKatakanaName('トクシマケン'));
        $this->assertSame('香川県', Converter::prefectureNameByKatakanaName('カガワケン'));
        $this->assertSame('愛媛県', Converter::prefectureNameByKatakanaName('エヒメケン'));
        $this->assertSame('高知県', Converter::prefectureNameByKatakanaName('コウチケン'));
        $this->assertSame('福岡県', Converter::prefectureNameByKatakanaName('フクオカケン'));
        $this->assertSame('佐賀県', Converter::prefectureNameByKatakanaName('サガケン'));
        $this->assertSame('長崎県', Converter::prefectureNameByKatakanaName('ナガサキケン'));
        $this->assertSame('熊本県', Converter::prefectureNameByKatakanaName('クマモトケン'));
        $this->assertSame('大分県', Converter::prefectureNameByKatakanaName('オオイタケン'));
        $this->assertSame('宮崎県', Converter::prefectureNameByKatakanaName('ミヤザキケン'));
        $this->assertSame('鹿児島県', Converter::prefectureNameByKatakanaName('カゴシマケン'));
        $this->assertSame('沖縄県', Converter::prefectureNameByKatakanaName('オキナワケン'));
        $this->assertNull(Converter::prefectureNameByKatakanaName('キョウテイ'));
        $this->assertNull(Converter::prefectureNameByKatakanaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureNameByEnglishName(): void
    {
        $this->assertSame('北海道', Converter::prefectureNameByEnglishName('hokkaido'));
        $this->assertSame('青森県', Converter::prefectureNameByEnglishName('aomori'));
        $this->assertSame('岩手県', Converter::prefectureNameByEnglishName('iwate'));
        $this->assertSame('宮城県', Converter::prefectureNameByEnglishName('miyagi'));
        $this->assertSame('秋田県', Converter::prefectureNameByEnglishName('akita'));
        $this->assertSame('山形県', Converter::prefectureNameByEnglishName('yamagata'));
        $this->assertSame('福島県', Converter::prefectureNameByEnglishName('fukushima'));
        $this->assertSame('茨城県', Converter::prefectureNameByEnglishName('ibaraki'));
        $this->assertSame('栃木県', Converter::prefectureNameByEnglishName('tochigi'));
        $this->assertSame('群馬県', Converter::prefectureNameByEnglishName('gunma'));
        $this->assertSame('埼玉県', Converter::prefectureNameByEnglishName('saitama'));
        $this->assertSame('千葉県', Converter::prefectureNameByEnglishName('chiba'));
        $this->assertSame('東京都', Converter::prefectureNameByEnglishName('tokyo'));
        $this->assertSame('神奈川県', Converter::prefectureNameByEnglishName('kanagawa'));
        $this->assertSame('新潟県', Converter::prefectureNameByEnglishName('niigata'));
        $this->assertSame('富山県', Converter::prefectureNameByEnglishName('toyama'));
        $this->assertSame('石川県', Converter::prefectureNameByEnglishName('ishikawa'));
        $this->assertSame('福井県', Converter::prefectureNameByEnglishName('fukui'));
        $this->assertSame('山梨県', Converter::prefectureNameByEnglishName('yamanashi'));
        $this->assertSame('長野県', Converter::prefectureNameByEnglishName('nagano'));
        $this->assertSame('岐阜県', Converter::prefectureNameByEnglishName('gifu'));
        $this->assertSame('静岡県', Converter::prefectureNameByEnglishName('shizuoka'));
        $this->assertSame('愛知県', Converter::prefectureNameByEnglishName('aichi'));
        $this->assertSame('三重県', Converter::prefectureNameByEnglishName('mie'));
        $this->assertSame('滋賀県', Converter::prefectureNameByEnglishName('shiga'));
        $this->assertSame('京都府', Converter::prefectureNameByEnglishName('kyoto'));
        $this->assertSame('大阪府', Converter::prefectureNameByEnglishName('osaka'));
        $this->assertSame('兵庫県', Converter::prefectureNameByEnglishName('hyogo'));
        $this->assertSame('奈良県', Converter::prefectureNameByEnglishName('nara'));
        $this->assertSame('和歌山県', Converter::prefectureNameByEnglishName('wakayama'));
        $this->assertSame('鳥取県', Converter::prefectureNameByEnglishName('tottori'));
        $this->assertSame('島根県', Converter::prefectureNameByEnglishName('shimane'));
        $this->assertSame('岡山県', Converter::prefectureNameByEnglishName('okayama'));
        $this->assertSame('広島県', Converter::prefectureNameByEnglishName('hiroshima'));
        $this->assertSame('山口県', Converter::prefectureNameByEnglishName('yamaguchi'));
        $this->assertSame('徳島県', Converter::prefectureNameByEnglishName('tokushima'));
        $this->assertSame('香川県', Converter::prefectureNameByEnglishName('kagawa'));
        $this->assertSame('愛媛県', Converter::prefectureNameByEnglishName('ehime'));
        $this->assertSame('高知県', Converter::prefectureNameByEnglishName('kochi'));
        $this->assertSame('福岡県', Converter::prefectureNameByEnglishName('fukuoka'));
        $this->assertSame('佐賀県', Converter::prefectureNameByEnglishName('saga'));
        $this->assertSame('長崎県', Converter::prefectureNameByEnglishName('nagasaki'));
        $this->assertSame('熊本県', Converter::prefectureNameByEnglishName('kumamoto'));
        $this->assertSame('大分県', Converter::prefectureNameByEnglishName('oita'));
        $this->assertSame('宮崎県', Converter::prefectureNameByEnglishName('miyazaki'));
        $this->assertSame('鹿児島県', Converter::prefectureNameByEnglishName('kagoshima'));
        $this->assertSame('沖縄県', Converter::prefectureNameByEnglishName('okinawa'));
        $this->assertNull(Converter::prefectureNameByEnglishName('kyotei'));
        $this->assertNull(Converter::prefectureNameByEnglishName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureShortNameById(): void
    {
        $this->assertSame('北海道', Converter::prefectureShortNameById(1));
        $this->assertSame('青森', Converter::prefectureShortNameById(2));
        $this->assertSame('岩手', Converter::prefectureShortNameById(3));
        $this->assertSame('宮城', Converter::prefectureShortNameById(4));
        $this->assertSame('秋田', Converter::prefectureShortNameById(5));
        $this->assertSame('山形', Converter::prefectureShortNameById(6));
        $this->assertSame('福島', Converter::prefectureShortNameById(7));
        $this->assertSame('茨城', Converter::prefectureShortNameById(8));
        $this->assertSame('栃木', Converter::prefectureShortNameById(9));
        $this->assertSame('群馬', Converter::prefectureShortNameById(10));
        $this->assertSame('埼玉', Converter::prefectureShortNameById(11));
        $this->assertSame('千葉', Converter::prefectureShortNameById(12));
        $this->assertSame('東京', Converter::prefectureShortNameById(13));
        $this->assertSame('神奈川', Converter::prefectureShortNameById(14));
        $this->assertSame('新潟', Converter::prefectureShortNameById(15));
        $this->assertSame('富山', Converter::prefectureShortNameById(16));
        $this->assertSame('石川', Converter::prefectureShortNameById(17));
        $this->assertSame('福井', Converter::prefectureShortNameById(18));
        $this->assertSame('山梨', Converter::prefectureShortNameById(19));
        $this->assertSame('長野', Converter::prefectureShortNameById(20));
        $this->assertSame('岐阜', Converter::prefectureShortNameById(21));
        $this->assertSame('静岡', Converter::prefectureShortNameById(22));
        $this->assertSame('愛知', Converter::prefectureShortNameById(23));
        $this->assertSame('三重', Converter::prefectureShortNameById(24));
        $this->assertSame('滋賀', Converter::prefectureShortNameById(25));
        $this->assertSame('京都', Converter::prefectureShortNameById(26));
        $this->assertSame('大阪', Converter::prefectureShortNameById(27));
        $this->assertSame('兵庫', Converter::prefectureShortNameById(28));
        $this->assertSame('奈良', Converter::prefectureShortNameById(29));
        $this->assertSame('和歌山', Converter::prefectureShortNameById(30));
        $this->assertSame('鳥取', Converter::prefectureShortNameById(31));
        $this->assertSame('島根', Converter::prefectureShortNameById(32));
        $this->assertSame('岡山', Converter::prefectureShortNameById(33));
        $this->assertSame('広島', Converter::prefectureShortNameById(34));
        $this->assertSame('山口', Converter::prefectureShortNameById(35));
        $this->assertSame('徳島', Converter::prefectureShortNameById(36));
        $this->assertSame('香川', Converter::prefectureShortNameById(37));
        $this->assertSame('愛媛', Converter::prefectureShortNameById(38));
        $this->assertSame('高知', Converter::prefectureShortNameById(39));
        $this->assertSame('福岡', Converter::prefectureShortNameById(40));
        $this->assertSame('佐賀', Converter::prefectureShortNameById(41));
        $this->assertSame('長崎', Converter::prefectureShortNameById(42));
        $this->assertSame('熊本', Converter::prefectureShortNameById(43));
        $this->assertSame('大分', Converter::prefectureShortNameById(44));
        $this->assertSame('宮崎', Converter::prefectureShortNameById(45));
        $this->assertSame('鹿児島', Converter::prefectureShortNameById(46));
        $this->assertSame('沖縄', Converter::prefectureShortNameById(47));
        $this->assertNull(Converter::prefectureShortNameById(48));
        $this->assertNull(Converter::prefectureShortNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureShortNameByName(): void
    {
        $this->assertSame('北海道', Converter::prefectureShortNameByName('北海道'));
        $this->assertSame('青森', Converter::prefectureShortNameByName('青森県'));
        $this->assertSame('岩手', Converter::prefectureShortNameByName('岩手県'));
        $this->assertSame('宮城', Converter::prefectureShortNameByName('宮城県'));
        $this->assertSame('秋田', Converter::prefectureShortNameByName('秋田県'));
        $this->assertSame('山形', Converter::prefectureShortNameByName('山形県'));
        $this->assertSame('福島', Converter::prefectureShortNameByName('福島県'));
        $this->assertSame('茨城', Converter::prefectureShortNameByName('茨城県'));
        $this->assertSame('栃木', Converter::prefectureShortNameByName('栃木県'));
        $this->assertSame('群馬', Converter::prefectureShortNameByName('群馬県'));
        $this->assertSame('埼玉', Converter::prefectureShortNameByName('埼玉県'));
        $this->assertSame('千葉', Converter::prefectureShortNameByName('千葉県'));
        $this->assertSame('東京', Converter::prefectureShortNameByName('東京都'));
        $this->assertSame('神奈川', Converter::prefectureShortNameByName('神奈川県'));
        $this->assertSame('新潟', Converter::prefectureShortNameByName('新潟県'));
        $this->assertSame('富山', Converter::prefectureShortNameByName('富山県'));
        $this->assertSame('石川', Converter::prefectureShortNameByName('石川県'));
        $this->assertSame('福井', Converter::prefectureShortNameByName('福井県'));
        $this->assertSame('山梨', Converter::prefectureShortNameByName('山梨県'));
        $this->assertSame('長野', Converter::prefectureShortNameByName('長野県'));
        $this->assertSame('岐阜', Converter::prefectureShortNameByName('岐阜県'));
        $this->assertSame('静岡', Converter::prefectureShortNameByName('静岡県'));
        $this->assertSame('愛知', Converter::prefectureShortNameByName('愛知県'));
        $this->assertSame('三重', Converter::prefectureShortNameByName('三重県'));
        $this->assertSame('滋賀', Converter::prefectureShortNameByName('滋賀県'));
        $this->assertSame('京都', Converter::prefectureShortNameByName('京都府'));
        $this->assertSame('大阪', Converter::prefectureShortNameByName('大阪府'));
        $this->assertSame('兵庫', Converter::prefectureShortNameByName('兵庫県'));
        $this->assertSame('奈良', Converter::prefectureShortNameByName('奈良県'));
        $this->assertSame('和歌山', Converter::prefectureShortNameByName('和歌山県'));
        $this->assertSame('鳥取', Converter::prefectureShortNameByName('鳥取県'));
        $this->assertSame('島根', Converter::prefectureShortNameByName('島根県'));
        $this->assertSame('岡山', Converter::prefectureShortNameByName('岡山県'));
        $this->assertSame('広島', Converter::prefectureShortNameByName('広島県'));
        $this->assertSame('山口', Converter::prefectureShortNameByName('山口県'));
        $this->assertSame('徳島', Converter::prefectureShortNameByName('徳島県'));
        $this->assertSame('香川', Converter::prefectureShortNameByName('香川県'));
        $this->assertSame('愛媛', Converter::prefectureShortNameByName('愛媛県'));
        $this->assertSame('高知', Converter::prefectureShortNameByName('高知県'));
        $this->assertSame('福岡', Converter::prefectureShortNameByName('福岡県'));
        $this->assertSame('佐賀', Converter::prefectureShortNameByName('佐賀県'));
        $this->assertSame('長崎', Converter::prefectureShortNameByName('長崎県'));
        $this->assertSame('熊本', Converter::prefectureShortNameByName('熊本県'));
        $this->assertSame('大分', Converter::prefectureShortNameByName('大分県'));
        $this->assertSame('宮崎', Converter::prefectureShortNameByName('宮崎県'));
        $this->assertSame('鹿児島', Converter::prefectureShortNameByName('鹿児島県'));
        $this->assertSame('沖縄', Converter::prefectureShortNameByName('沖縄県'));
        $this->assertNull(Converter::prefectureShortNameByName('競艇'));
        $this->assertNull(Converter::prefectureShortNameByName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureShortNameByHiraganaName(): void
    {
        $this->assertSame('北海道', Converter::prefectureShortNameByHiraganaName('ほっかいどう'));
        $this->assertSame('青森', Converter::prefectureShortNameByHiraganaName('あおもりけん'));
        $this->assertSame('岩手', Converter::prefectureShortNameByHiraganaName('いわてけん'));
        $this->assertSame('宮城', Converter::prefectureShortNameByHiraganaName('みやぎけん'));
        $this->assertSame('秋田', Converter::prefectureShortNameByHiraganaName('あきたけん'));
        $this->assertSame('山形', Converter::prefectureShortNameByHiraganaName('やまがたけん'));
        $this->assertSame('福島', Converter::prefectureShortNameByHiraganaName('ふくしまけん'));
        $this->assertSame('茨城', Converter::prefectureShortNameByHiraganaName('いばらきけん'));
        $this->assertSame('栃木', Converter::prefectureShortNameByHiraganaName('とちぎけん'));
        $this->assertSame('群馬', Converter::prefectureShortNameByHiraganaName('ぐんまけん'));
        $this->assertSame('埼玉', Converter::prefectureShortNameByHiraganaName('さいたまけん'));
        $this->assertSame('千葉', Converter::prefectureShortNameByHiraganaName('ちばけん'));
        $this->assertSame('東京', Converter::prefectureShortNameByHiraganaName('とうきょうと'));
        $this->assertSame('神奈川', Converter::prefectureShortNameByHiraganaName('かながわけん'));
        $this->assertSame('新潟', Converter::prefectureShortNameByHiraganaName('にいがたけん'));
        $this->assertSame('富山', Converter::prefectureShortNameByHiraganaName('とやまけん'));
        $this->assertSame('石川', Converter::prefectureShortNameByHiraganaName('いしかわけん'));
        $this->assertSame('福井', Converter::prefectureShortNameByHiraganaName('ふくいけん'));
        $this->assertSame('山梨', Converter::prefectureShortNameByHiraganaName('やまなしけん'));
        $this->assertSame('長野', Converter::prefectureShortNameByHiraganaName('ながのけん'));
        $this->assertSame('岐阜', Converter::prefectureShortNameByHiraganaName('ぎふけん'));
        $this->assertSame('静岡', Converter::prefectureShortNameByHiraganaName('しずおかけん'));
        $this->assertSame('愛知', Converter::prefectureShortNameByHiraganaName('あいちけん'));
        $this->assertSame('三重', Converter::prefectureShortNameByHiraganaName('みえけん'));
        $this->assertSame('滋賀', Converter::prefectureShortNameByHiraganaName('しがけん'));
        $this->assertSame('京都', Converter::prefectureShortNameByHiraganaName('きょうとふ'));
        $this->assertSame('大阪', Converter::prefectureShortNameByHiraganaName('おおさかふ'));
        $this->assertSame('兵庫', Converter::prefectureShortNameByHiraganaName('ひょうごけん'));
        $this->assertSame('奈良', Converter::prefectureShortNameByHiraganaName('ならけん'));
        $this->assertSame('和歌山', Converter::prefectureShortNameByHiraganaName('わかやまけん'));
        $this->assertSame('鳥取', Converter::prefectureShortNameByHiraganaName('とっとりけん'));
        $this->assertSame('島根', Converter::prefectureShortNameByHiraganaName('しまねけん'));
        $this->assertSame('岡山', Converter::prefectureShortNameByHiraganaName('おかやまけん'));
        $this->assertSame('広島', Converter::prefectureShortNameByHiraganaName('ひろしまけん'));
        $this->assertSame('山口', Converter::prefectureShortNameByHiraganaName('やまぐちけん'));
        $this->assertSame('徳島', Converter::prefectureShortNameByHiraganaName('とくしまけん'));
        $this->assertSame('香川', Converter::prefectureShortNameByHiraganaName('かがわけん'));
        $this->assertSame('愛媛', Converter::prefectureShortNameByHiraganaName('えひめけん'));
        $this->assertSame('高知', Converter::prefectureShortNameByHiraganaName('こうちけん'));
        $this->assertSame('福岡', Converter::prefectureShortNameByHiraganaName('ふくおかけん'));
        $this->assertSame('佐賀', Converter::prefectureShortNameByHiraganaName('さがけん'));
        $this->assertSame('長崎', Converter::prefectureShortNameByHiraganaName('ながさきけん'));
        $this->assertSame('熊本', Converter::prefectureShortNameByHiraganaName('くまもとけん'));
        $this->assertSame('大分', Converter::prefectureShortNameByHiraganaName('おおいたけん'));
        $this->assertSame('宮崎', Converter::prefectureShortNameByHiraganaName('みやざきけん'));
        $this->assertSame('鹿児島', Converter::prefectureShortNameByHiraganaName('かごしまけん'));
        $this->assertSame('沖縄', Converter::prefectureShortNameByHiraganaName('おきなわけん'));
        $this->assertNull(Converter::prefectureShortNameByHiraganaName('きょうてい'));
        $this->assertNull(Converter::prefectureShortNameByHiraganaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureShortNameByKatakanaName(): void
    {
        $this->assertSame('北海道', Converter::prefectureShortNameByKatakanaName('ホッカイドウ'));
        $this->assertSame('青森', Converter::prefectureShortNameByKatakanaName('アオモリケン'));
        $this->assertSame('岩手', Converter::prefectureShortNameByKatakanaName('イワテケン'));
        $this->assertSame('宮城', Converter::prefectureShortNameByKatakanaName('ミヤギケン'));
        $this->assertSame('秋田', Converter::prefectureShortNameByKatakanaName('アキタケン'));
        $this->assertSame('山形', Converter::prefectureShortNameByKatakanaName('ヤマガタケン'));
        $this->assertSame('福島', Converter::prefectureShortNameByKatakanaName('フクシマケン'));
        $this->assertSame('茨城', Converter::prefectureShortNameByKatakanaName('イバラキケン'));
        $this->assertSame('栃木', Converter::prefectureShortNameByKatakanaName('トチギケン'));
        $this->assertSame('群馬', Converter::prefectureShortNameByKatakanaName('グンマケン'));
        $this->assertSame('埼玉', Converter::prefectureShortNameByKatakanaName('サイタマケン'));
        $this->assertSame('千葉', Converter::prefectureShortNameByKatakanaName('チバケン'));
        $this->assertSame('東京', Converter::prefectureShortNameByKatakanaName('トウキョウト'));
        $this->assertSame('神奈川', Converter::prefectureShortNameByKatakanaName('カナガワケン'));
        $this->assertSame('新潟', Converter::prefectureShortNameByKatakanaName('ニイガタケン'));
        $this->assertSame('富山', Converter::prefectureShortNameByKatakanaName('トヤマケン'));
        $this->assertSame('石川', Converter::prefectureShortNameByKatakanaName('イシカワケン'));
        $this->assertSame('福井', Converter::prefectureShortNameByKatakanaName('フクイケン'));
        $this->assertSame('山梨', Converter::prefectureShortNameByKatakanaName('ヤマナシケン'));
        $this->assertSame('長野', Converter::prefectureShortNameByKatakanaName('ナガノケン'));
        $this->assertSame('岐阜', Converter::prefectureShortNameByKatakanaName('ギフケン'));
        $this->assertSame('静岡', Converter::prefectureShortNameByKatakanaName('シズオカケン'));
        $this->assertSame('愛知', Converter::prefectureShortNameByKatakanaName('アイチケン'));
        $this->assertSame('三重', Converter::prefectureShortNameByKatakanaName('ミエケン'));
        $this->assertSame('滋賀', Converter::prefectureShortNameByKatakanaName('シガケン'));
        $this->assertSame('京都', Converter::prefectureShortNameByKatakanaName('キョウトフ'));
        $this->assertSame('大阪', Converter::prefectureShortNameByKatakanaName('オオサカフ'));
        $this->assertSame('兵庫', Converter::prefectureShortNameByKatakanaName('ヒョウゴケン'));
        $this->assertSame('奈良', Converter::prefectureShortNameByKatakanaName('ナラケン'));
        $this->assertSame('和歌山', Converter::prefectureShortNameByKatakanaName('ワカヤマケン'));
        $this->assertSame('鳥取', Converter::prefectureShortNameByKatakanaName('トットリケン'));
        $this->assertSame('島根', Converter::prefectureShortNameByKatakanaName('シマネケン'));
        $this->assertSame('岡山', Converter::prefectureShortNameByKatakanaName('オカヤマケン'));
        $this->assertSame('広島', Converter::prefectureShortNameByKatakanaName('ヒロシマケン'));
        $this->assertSame('山口', Converter::prefectureShortNameByKatakanaName('ヤマグチケン'));
        $this->assertSame('徳島', Converter::prefectureShortNameByKatakanaName('トクシマケン'));
        $this->assertSame('香川', Converter::prefectureShortNameByKatakanaName('カガワケン'));
        $this->assertSame('愛媛', Converter::prefectureShortNameByKatakanaName('エヒメケン'));
        $this->assertSame('高知', Converter::prefectureShortNameByKatakanaName('コウチケン'));
        $this->assertSame('福岡', Converter::prefectureShortNameByKatakanaName('フクオカケン'));
        $this->assertSame('佐賀', Converter::prefectureShortNameByKatakanaName('サガケン'));
        $this->assertSame('長崎', Converter::prefectureShortNameByKatakanaName('ナガサキケン'));
        $this->assertSame('熊本', Converter::prefectureShortNameByKatakanaName('クマモトケン'));
        $this->assertSame('大分', Converter::prefectureShortNameByKatakanaName('オオイタケン'));
        $this->assertSame('宮崎', Converter::prefectureShortNameByKatakanaName('ミヤザキケン'));
        $this->assertSame('鹿児島', Converter::prefectureShortNameByKatakanaName('カゴシマケン'));
        $this->assertSame('沖縄', Converter::prefectureShortNameByKatakanaName('オキナワケン'));
        $this->assertNull(Converter::prefectureShortNameByKatakanaName('キョウテイ'));
        $this->assertNull(Converter::prefectureShortNameByKatakanaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureShortNameByEnglishName(): void
    {
        $this->assertSame('北海道', Converter::prefectureShortNameByEnglishName('hokkaido'));
        $this->assertSame('青森', Converter::prefectureShortNameByEnglishName('aomori'));
        $this->assertSame('岩手', Converter::prefectureShortNameByEnglishName('iwate'));
        $this->assertSame('宮城', Converter::prefectureShortNameByEnglishName('miyagi'));
        $this->assertSame('秋田', Converter::prefectureShortNameByEnglishName('akita'));
        $this->assertSame('山形', Converter::prefectureShortNameByEnglishName('yamagata'));
        $this->assertSame('福島', Converter::prefectureShortNameByEnglishName('fukushima'));
        $this->assertSame('茨城', Converter::prefectureShortNameByEnglishName('ibaraki'));
        $this->assertSame('栃木', Converter::prefectureShortNameByEnglishName('tochigi'));
        $this->assertSame('群馬', Converter::prefectureShortNameByEnglishName('gunma'));
        $this->assertSame('埼玉', Converter::prefectureShortNameByEnglishName('saitama'));
        $this->assertSame('千葉', Converter::prefectureShortNameByEnglishName('chiba'));
        $this->assertSame('東京', Converter::prefectureShortNameByEnglishName('tokyo'));
        $this->assertSame('神奈川', Converter::prefectureShortNameByEnglishName('kanagawa'));
        $this->assertSame('新潟', Converter::prefectureShortNameByEnglishName('niigata'));
        $this->assertSame('富山', Converter::prefectureShortNameByEnglishName('toyama'));
        $this->assertSame('石川', Converter::prefectureShortNameByEnglishName('ishikawa'));
        $this->assertSame('福井', Converter::prefectureShortNameByEnglishName('fukui'));
        $this->assertSame('山梨', Converter::prefectureShortNameByEnglishName('yamanashi'));
        $this->assertSame('長野', Converter::prefectureShortNameByEnglishName('nagano'));
        $this->assertSame('岐阜', Converter::prefectureShortNameByEnglishName('gifu'));
        $this->assertSame('静岡', Converter::prefectureShortNameByEnglishName('shizuoka'));
        $this->assertSame('愛知', Converter::prefectureShortNameByEnglishName('aichi'));
        $this->assertSame('三重', Converter::prefectureShortNameByEnglishName('mie'));
        $this->assertSame('滋賀', Converter::prefectureShortNameByEnglishName('shiga'));
        $this->assertSame('京都', Converter::prefectureShortNameByEnglishName('kyoto'));
        $this->assertSame('大阪', Converter::prefectureShortNameByEnglishName('osaka'));
        $this->assertSame('兵庫', Converter::prefectureShortNameByEnglishName('hyogo'));
        $this->assertSame('奈良', Converter::prefectureShortNameByEnglishName('nara'));
        $this->assertSame('和歌山', Converter::prefectureShortNameByEnglishName('wakayama'));
        $this->assertSame('鳥取', Converter::prefectureShortNameByEnglishName('tottori'));
        $this->assertSame('島根', Converter::prefectureShortNameByEnglishName('shimane'));
        $this->assertSame('岡山', Converter::prefectureShortNameByEnglishName('okayama'));
        $this->assertSame('広島', Converter::prefectureShortNameByEnglishName('hiroshima'));
        $this->assertSame('山口', Converter::prefectureShortNameByEnglishName('yamaguchi'));
        $this->assertSame('徳島', Converter::prefectureShortNameByEnglishName('tokushima'));
        $this->assertSame('香川', Converter::prefectureShortNameByEnglishName('kagawa'));
        $this->assertSame('愛媛', Converter::prefectureShortNameByEnglishName('ehime'));
        $this->assertSame('高知', Converter::prefectureShortNameByEnglishName('kochi'));
        $this->assertSame('福岡', Converter::prefectureShortNameByEnglishName('fukuoka'));
        $this->assertSame('佐賀', Converter::prefectureShortNameByEnglishName('saga'));
        $this->assertSame('長崎', Converter::prefectureShortNameByEnglishName('nagasaki'));
        $this->assertSame('熊本', Converter::prefectureShortNameByEnglishName('kumamoto'));
        $this->assertSame('大分', Converter::prefectureShortNameByEnglishName('oita'));
        $this->assertSame('宮崎', Converter::prefectureShortNameByEnglishName('miyazaki'));
        $this->assertSame('鹿児島', Converter::prefectureShortNameByEnglishName('kagoshima'));
        $this->assertSame('沖縄', Converter::prefectureShortNameByEnglishName('okinawa'));
        $this->assertNull(Converter::prefectureShortNameByEnglishName('kyotei'));
        $this->assertNull(Converter::prefectureShortNameByEnglishName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureHiraganaNameById(): void
    {
        $this->assertSame('ほっかいどう', Converter::prefectureHiraganaNameById(1));
        $this->assertSame('あおもりけん', Converter::prefectureHiraganaNameById(2));
        $this->assertSame('いわてけん', Converter::prefectureHiraganaNameById(3));
        $this->assertSame('みやぎけん', Converter::prefectureHiraganaNameById(4));
        $this->assertSame('あきたけん', Converter::prefectureHiraganaNameById(5));
        $this->assertSame('やまがたけん', Converter::prefectureHiraganaNameById(6));
        $this->assertSame('ふくしまけん', Converter::prefectureHiraganaNameById(7));
        $this->assertSame('いばらきけん', Converter::prefectureHiraganaNameById(8));
        $this->assertSame('とちぎけん', Converter::prefectureHiraganaNameById(9));
        $this->assertSame('ぐんまけん', Converter::prefectureHiraganaNameById(10));
        $this->assertSame('さいたまけん', Converter::prefectureHiraganaNameById(11));
        $this->assertSame('ちばけん', Converter::prefectureHiraganaNameById(12));
        $this->assertSame('とうきょうと', Converter::prefectureHiraganaNameById(13));
        $this->assertSame('かながわけん', Converter::prefectureHiraganaNameById(14));
        $this->assertSame('にいがたけん', Converter::prefectureHiraganaNameById(15));
        $this->assertSame('とやまけん', Converter::prefectureHiraganaNameById(16));
        $this->assertSame('いしかわけん', Converter::prefectureHiraganaNameById(17));
        $this->assertSame('ふくいけん', Converter::prefectureHiraganaNameById(18));
        $this->assertSame('やまなしけん', Converter::prefectureHiraganaNameById(19));
        $this->assertSame('ながのけん', Converter::prefectureHiraganaNameById(20));
        $this->assertSame('ぎふけん', Converter::prefectureHiraganaNameById(21));
        $this->assertSame('しずおかけん', Converter::prefectureHiraganaNameById(22));
        $this->assertSame('あいちけん', Converter::prefectureHiraganaNameById(23));
        $this->assertSame('みえけん', Converter::prefectureHiraganaNameById(24));
        $this->assertSame('しがけん', Converter::prefectureHiraganaNameById(25));
        $this->assertSame('きょうとふ', Converter::prefectureHiraganaNameById(26));
        $this->assertSame('おおさかふ', Converter::prefectureHiraganaNameById(27));
        $this->assertSame('ひょうごけん', Converter::prefectureHiraganaNameById(28));
        $this->assertSame('ならけん', Converter::prefectureHiraganaNameById(29));
        $this->assertSame('わかやまけん', Converter::prefectureHiraganaNameById(30));
        $this->assertSame('とっとりけん', Converter::prefectureHiraganaNameById(31));
        $this->assertSame('しまねけん', Converter::prefectureHiraganaNameById(32));
        $this->assertSame('おかやまけん', Converter::prefectureHiraganaNameById(33));
        $this->assertSame('ひろしまけん', Converter::prefectureHiraganaNameById(34));
        $this->assertSame('やまぐちけん', Converter::prefectureHiraganaNameById(35));
        $this->assertSame('とくしまけん', Converter::prefectureHiraganaNameById(36));
        $this->assertSame('かがわけん', Converter::prefectureHiraganaNameById(37));
        $this->assertSame('えひめけん', Converter::prefectureHiraganaNameById(38));
        $this->assertSame('こうちけん', Converter::prefectureHiraganaNameById(39));
        $this->assertSame('ふくおかけん', Converter::prefectureHiraganaNameById(40));
        $this->assertSame('さがけん', Converter::prefectureHiraganaNameById(41));
        $this->assertSame('ながさきけん', Converter::prefectureHiraganaNameById(42));
        $this->assertSame('くまもとけん', Converter::prefectureHiraganaNameById(43));
        $this->assertSame('おおいたけん', Converter::prefectureHiraganaNameById(44));
        $this->assertSame('みやざきけん', Converter::prefectureHiraganaNameById(45));
        $this->assertSame('かごしまけん', Converter::prefectureHiraganaNameById(46));
        $this->assertSame('おきなわけん', Converter::prefectureHiraganaNameById(47));
        $this->assertNull(Converter::prefectureNameById(48));
        $this->assertNull(Converter::prefectureNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureHiraganaNameByName(): void
    {
        $this->assertSame('ほっかいどう', Converter::prefectureHiraganaNameByName('北海道'));
        $this->assertSame('あおもりけん', Converter::prefectureHiraganaNameByName('青森県'));
        $this->assertSame('いわてけん', Converter::prefectureHiraganaNameByName('岩手県'));
        $this->assertSame('みやぎけん', Converter::prefectureHiraganaNameByName('宮城県'));
        $this->assertSame('あきたけん', Converter::prefectureHiraganaNameByName('秋田県'));
        $this->assertSame('やまがたけん', Converter::prefectureHiraganaNameByName('山形県'));
        $this->assertSame('ふくしまけん', Converter::prefectureHiraganaNameByName('福島県'));
        $this->assertSame('いばらきけん', Converter::prefectureHiraganaNameByName('茨城県'));
        $this->assertSame('とちぎけん', Converter::prefectureHiraganaNameByName('栃木県'));
        $this->assertSame('ぐんまけん', Converter::prefectureHiraganaNameByName('群馬県'));
        $this->assertSame('さいたまけん', Converter::prefectureHiraganaNameByName('埼玉県'));
        $this->assertSame('ちばけん', Converter::prefectureHiraganaNameByName('千葉県'));
        $this->assertSame('とうきょうと', Converter::prefectureHiraganaNameByName('東京都'));
        $this->assertSame('かながわけん', Converter::prefectureHiraganaNameByName('神奈川県'));
        $this->assertSame('にいがたけん', Converter::prefectureHiraganaNameByName('新潟県'));
        $this->assertSame('とやまけん', Converter::prefectureHiraganaNameByName('富山県'));
        $this->assertSame('いしかわけん', Converter::prefectureHiraganaNameByName('石川県'));
        $this->assertSame('ふくいけん', Converter::prefectureHiraganaNameByName('福井県'));
        $this->assertSame('やまなしけん', Converter::prefectureHiraganaNameByName('山梨県'));
        $this->assertSame('ながのけん', Converter::prefectureHiraganaNameByName('長野県'));
        $this->assertSame('ぎふけん', Converter::prefectureHiraganaNameByName('岐阜県'));
        $this->assertSame('しずおかけん', Converter::prefectureHiraganaNameByName('静岡県'));
        $this->assertSame('あいちけん', Converter::prefectureHiraganaNameByName('愛知県'));
        $this->assertSame('みえけん', Converter::prefectureHiraganaNameByName('三重県'));
        $this->assertSame('しがけん', Converter::prefectureHiraganaNameByName('滋賀県'));
        $this->assertSame('きょうとふ', Converter::prefectureHiraganaNameByName('京都府'));
        $this->assertSame('おおさかふ', Converter::prefectureHiraganaNameByName('大阪府'));
        $this->assertSame('ひょうごけん', Converter::prefectureHiraganaNameByName('兵庫県'));
        $this->assertSame('ならけん', Converter::prefectureHiraganaNameByName('奈良県'));
        $this->assertSame('わかやまけん', Converter::prefectureHiraganaNameByName('和歌山県'));
        $this->assertSame('とっとりけん', Converter::prefectureHiraganaNameByName('鳥取県'));
        $this->assertSame('しまねけん', Converter::prefectureHiraganaNameByName('島根県'));
        $this->assertSame('おかやまけん', Converter::prefectureHiraganaNameByName('岡山県'));
        $this->assertSame('ひろしまけん', Converter::prefectureHiraganaNameByName('広島県'));
        $this->assertSame('やまぐちけん', Converter::prefectureHiraganaNameByName('山口県'));
        $this->assertSame('とくしまけん', Converter::prefectureHiraganaNameByName('徳島県'));
        $this->assertSame('かがわけん', Converter::prefectureHiraganaNameByName('香川県'));
        $this->assertSame('えひめけん', Converter::prefectureHiraganaNameByName('愛媛県'));
        $this->assertSame('こうちけん', Converter::prefectureHiraganaNameByName('高知県'));
        $this->assertSame('ふくおかけん', Converter::prefectureHiraganaNameByName('福岡県'));
        $this->assertSame('さがけん', Converter::prefectureHiraganaNameByName('佐賀県'));
        $this->assertSame('ながさきけん', Converter::prefectureHiraganaNameByName('長崎県'));
        $this->assertSame('くまもとけん', Converter::prefectureHiraganaNameByName('熊本県'));
        $this->assertSame('おおいたけん', Converter::prefectureHiraganaNameByName('大分県'));
        $this->assertSame('みやざきけん', Converter::prefectureHiraganaNameByName('宮崎県'));
        $this->assertSame('かごしまけん', Converter::prefectureHiraganaNameByName('鹿児島県'));
        $this->assertSame('おきなわけん', Converter::prefectureHiraganaNameByName('沖縄県'));
        $this->assertNull(Converter::prefectureHiraganaNameByName('競艇'));
        $this->assertNull(Converter::prefectureHiraganaNameByName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureHiraganaNameByShortName(): void
    {
        $this->assertSame('ほっかいどう', Converter::prefectureHiraganaNameByShortName('北海道'));
        $this->assertSame('あおもりけん', Converter::prefectureHiraganaNameByShortName('青森'));
        $this->assertSame('いわてけん', Converter::prefectureHiraganaNameByShortName('岩手'));
        $this->assertSame('みやぎけん', Converter::prefectureHiraganaNameByShortName('宮城'));
        $this->assertSame('あきたけん', Converter::prefectureHiraganaNameByShortName('秋田'));
        $this->assertSame('やまがたけん', Converter::prefectureHiraganaNameByShortName('山形'));
        $this->assertSame('ふくしまけん', Converter::prefectureHiraganaNameByShortName('福島'));
        $this->assertSame('いばらきけん', Converter::prefectureHiraganaNameByShortName('茨城'));
        $this->assertSame('とちぎけん', Converter::prefectureHiraganaNameByShortName('栃木'));
        $this->assertSame('ぐんまけん', Converter::prefectureHiraganaNameByShortName('群馬'));
        $this->assertSame('さいたまけん', Converter::prefectureHiraganaNameByShortName('埼玉'));
        $this->assertSame('ちばけん', Converter::prefectureHiraganaNameByShortName('千葉'));
        $this->assertSame('とうきょうと', Converter::prefectureHiraganaNameByShortName('東京'));
        $this->assertSame('かながわけん', Converter::prefectureHiraganaNameByShortName('神奈川'));
        $this->assertSame('にいがたけん', Converter::prefectureHiraganaNameByShortName('新潟'));
        $this->assertSame('とやまけん', Converter::prefectureHiraganaNameByShortName('富山'));
        $this->assertSame('いしかわけん', Converter::prefectureHiraganaNameByShortName('石川'));
        $this->assertSame('ふくいけん', Converter::prefectureHiraganaNameByShortName('福井'));
        $this->assertSame('やまなしけん', Converter::prefectureHiraganaNameByShortName('山梨'));
        $this->assertSame('ながのけん', Converter::prefectureHiraganaNameByShortName('長野'));
        $this->assertSame('ぎふけん', Converter::prefectureHiraganaNameByShortName('岐阜'));
        $this->assertSame('しずおかけん', Converter::prefectureHiraganaNameByShortName('静岡'));
        $this->assertSame('あいちけん', Converter::prefectureHiraganaNameByShortName('愛知'));
        $this->assertSame('みえけん', Converter::prefectureHiraganaNameByShortName('三重'));
        $this->assertSame('しがけん', Converter::prefectureHiraganaNameByShortName('滋賀'));
        $this->assertSame('きょうとふ', Converter::prefectureHiraganaNameByShortName('京都'));
        $this->assertSame('おおさかふ', Converter::prefectureHiraganaNameByShortName('大阪'));
        $this->assertSame('ひょうごけん', Converter::prefectureHiraganaNameByShortName('兵庫'));
        $this->assertSame('ならけん', Converter::prefectureHiraganaNameByShortName('奈良'));
        $this->assertSame('わかやまけん', Converter::prefectureHiraganaNameByShortName('和歌山'));
        $this->assertSame('とっとりけん', Converter::prefectureHiraganaNameByShortName('鳥取'));
        $this->assertSame('しまねけん', Converter::prefectureHiraganaNameByShortName('島根'));
        $this->assertSame('おかやまけん', Converter::prefectureHiraganaNameByShortName('岡山'));
        $this->assertSame('ひろしまけん', Converter::prefectureHiraganaNameByShortName('広島'));
        $this->assertSame('やまぐちけん', Converter::prefectureHiraganaNameByShortName('山口'));
        $this->assertSame('とくしまけん', Converter::prefectureHiraganaNameByShortName('徳島'));
        $this->assertSame('かがわけん', Converter::prefectureHiraganaNameByShortName('香川'));
        $this->assertSame('えひめけん', Converter::prefectureHiraganaNameByShortName('愛媛'));
        $this->assertSame('こうちけん', Converter::prefectureHiraganaNameByShortName('高知'));
        $this->assertSame('ふくおかけん', Converter::prefectureHiraganaNameByShortName('福岡'));
        $this->assertSame('さがけん', Converter::prefectureHiraganaNameByShortName('佐賀'));
        $this->assertSame('ながさきけん', Converter::prefectureHiraganaNameByShortName('長崎'));
        $this->assertSame('くまもとけん', Converter::prefectureHiraganaNameByShortName('熊本'));
        $this->assertSame('おおいたけん', Converter::prefectureHiraganaNameByShortName('大分'));
        $this->assertSame('みやざきけん', Converter::prefectureHiraganaNameByShortName('宮崎'));
        $this->assertSame('かごしまけん', Converter::prefectureHiraganaNameByShortName('鹿児島'));
        $this->assertSame('おきなわけん', Converter::prefectureHiraganaNameByShortName('沖縄'));
        $this->assertNull(Converter::prefectureHiraganaNameByShortName('競艇'));
        $this->assertNull(Converter::prefectureHiraganaNameByShortName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureHiraganaNameByKatakanaName(): void
    {
        $this->assertSame('ほっかいどう', Converter::prefectureHiraganaNameByKatakanaName('ホッカイドウ'));
        $this->assertSame('あおもりけん', Converter::prefectureHiraganaNameByKatakanaName('アオモリケン'));
        $this->assertSame('いわてけん', Converter::prefectureHiraganaNameByKatakanaName('イワテケン'));
        $this->assertSame('みやぎけん', Converter::prefectureHiraganaNameByKatakanaName('ミヤギケン'));
        $this->assertSame('あきたけん', Converter::prefectureHiraganaNameByKatakanaName('アキタケン'));
        $this->assertSame('やまがたけん', Converter::prefectureHiraganaNameByKatakanaName('ヤマガタケン'));
        $this->assertSame('ふくしまけん', Converter::prefectureHiraganaNameByKatakanaName('フクシマケン'));
        $this->assertSame('いばらきけん', Converter::prefectureHiraganaNameByKatakanaName('イバラキケン'));
        $this->assertSame('とちぎけん', Converter::prefectureHiraganaNameByKatakanaName('トチギケン'));
        $this->assertSame('ぐんまけん', Converter::prefectureHiraganaNameByKatakanaName('グンマケン'));
        $this->assertSame('さいたまけん', Converter::prefectureHiraganaNameByKatakanaName('サイタマケン'));
        $this->assertSame('ちばけん', Converter::prefectureHiraganaNameByKatakanaName('チバケン'));
        $this->assertSame('とうきょうと', Converter::prefectureHiraganaNameByKatakanaName('トウキョウト'));
        $this->assertSame('かながわけん', Converter::prefectureHiraganaNameByKatakanaName('カナガワケン'));
        $this->assertSame('にいがたけん', Converter::prefectureHiraganaNameByKatakanaName('ニイガタケン'));
        $this->assertSame('とやまけん', Converter::prefectureHiraganaNameByKatakanaName('トヤマケン'));
        $this->assertSame('いしかわけん', Converter::prefectureHiraganaNameByKatakanaName('イシカワケン'));
        $this->assertSame('ふくいけん', Converter::prefectureHiraganaNameByKatakanaName('フクイケン'));
        $this->assertSame('やまなしけん', Converter::prefectureHiraganaNameByKatakanaName('ヤマナシケン'));
        $this->assertSame('ながのけん', Converter::prefectureHiraganaNameByKatakanaName('ナガノケン'));
        $this->assertSame('ぎふけん', Converter::prefectureHiraganaNameByKatakanaName('ギフケン'));
        $this->assertSame('しずおかけん', Converter::prefectureHiraganaNameByKatakanaName('シズオカケン'));
        $this->assertSame('あいちけん', Converter::prefectureHiraganaNameByKatakanaName('アイチケン'));
        $this->assertSame('みえけん', Converter::prefectureHiraganaNameByKatakanaName('ミエケン'));
        $this->assertSame('しがけん', Converter::prefectureHiraganaNameByKatakanaName('シガケン'));
        $this->assertSame('きょうとふ', Converter::prefectureHiraganaNameByKatakanaName('キョウトフ'));
        $this->assertSame('おおさかふ', Converter::prefectureHiraganaNameByKatakanaName('オオサカフ'));
        $this->assertSame('ひょうごけん', Converter::prefectureHiraganaNameByKatakanaName('ヒョウゴケン'));
        $this->assertSame('ならけん', Converter::prefectureHiraganaNameByKatakanaName('ナラケン'));
        $this->assertSame('わかやまけん', Converter::prefectureHiraganaNameByKatakanaName('ワカヤマケン'));
        $this->assertSame('とっとりけん', Converter::prefectureHiraganaNameByKatakanaName('トットリケン'));
        $this->assertSame('しまねけん', Converter::prefectureHiraganaNameByKatakanaName('シマネケン'));
        $this->assertSame('おかやまけん', Converter::prefectureHiraganaNameByKatakanaName('オカヤマケン'));
        $this->assertSame('ひろしまけん', Converter::prefectureHiraganaNameByKatakanaName('ヒロシマケン'));
        $this->assertSame('やまぐちけん', Converter::prefectureHiraganaNameByKatakanaName('ヤマグチケン'));
        $this->assertSame('とくしまけん', Converter::prefectureHiraganaNameByKatakanaName('トクシマケン'));
        $this->assertSame('かがわけん', Converter::prefectureHiraganaNameByKatakanaName('カガワケン'));
        $this->assertSame('えひめけん', Converter::prefectureHiraganaNameByKatakanaName('エヒメケン'));
        $this->assertSame('こうちけん', Converter::prefectureHiraganaNameByKatakanaName('コウチケン'));
        $this->assertSame('ふくおかけん', Converter::prefectureHiraganaNameByKatakanaName('フクオカケン'));
        $this->assertSame('さがけん', Converter::prefectureHiraganaNameByKatakanaName('サガケン'));
        $this->assertSame('ながさきけん', Converter::prefectureHiraganaNameByKatakanaName('ナガサキケン'));
        $this->assertSame('くまもとけん', Converter::prefectureHiraganaNameByKatakanaName('クマモトケン'));
        $this->assertSame('おおいたけん', Converter::prefectureHiraganaNameByKatakanaName('オオイタケン'));
        $this->assertSame('みやざきけん', Converter::prefectureHiraganaNameByKatakanaName('ミヤザキケン'));
        $this->assertSame('かごしまけん', Converter::prefectureHiraganaNameByKatakanaName('カゴシマケン'));
        $this->assertSame('おきなわけん', Converter::prefectureHiraganaNameByKatakanaName('オキナワケン'));
        $this->assertNull(Converter::prefectureHiraganaNameByKatakanaName('キョウテイ'));
        $this->assertNull(Converter::prefectureHiraganaNameByKatakanaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureHiraganaNameByEnglishName(): void
    {
        $this->assertSame('ほっかいどう', Converter::prefectureHiraganaNameByEnglishName('hokkaido'));
        $this->assertSame('あおもりけん', Converter::prefectureHiraganaNameByEnglishName('aomori'));
        $this->assertSame('いわてけん', Converter::prefectureHiraganaNameByEnglishName('iwate'));
        $this->assertSame('みやぎけん', Converter::prefectureHiraganaNameByEnglishName('miyagi'));
        $this->assertSame('あきたけん', Converter::prefectureHiraganaNameByEnglishName('akita'));
        $this->assertSame('やまがたけん', Converter::prefectureHiraganaNameByEnglishName('yamagata'));
        $this->assertSame('ふくしまけん', Converter::prefectureHiraganaNameByEnglishName('fukushima'));
        $this->assertSame('いばらきけん', Converter::prefectureHiraganaNameByEnglishName('ibaraki'));
        $this->assertSame('とちぎけん', Converter::prefectureHiraganaNameByEnglishName('tochigi'));
        $this->assertSame('ぐんまけん', Converter::prefectureHiraganaNameByEnglishName('gunma'));
        $this->assertSame('さいたまけん', Converter::prefectureHiraganaNameByEnglishName('saitama'));
        $this->assertSame('ちばけん', Converter::prefectureHiraganaNameByEnglishName('chiba'));
        $this->assertSame('とうきょうと', Converter::prefectureHiraganaNameByEnglishName('tokyo'));
        $this->assertSame('かながわけん', Converter::prefectureHiraganaNameByEnglishName('kanagawa'));
        $this->assertSame('にいがたけん', Converter::prefectureHiraganaNameByEnglishName('niigata'));
        $this->assertSame('とやまけん', Converter::prefectureHiraganaNameByEnglishName('toyama'));
        $this->assertSame('いしかわけん', Converter::prefectureHiraganaNameByEnglishName('ishikawa'));
        $this->assertSame('ふくいけん', Converter::prefectureHiraganaNameByEnglishName('fukui'));
        $this->assertSame('やまなしけん', Converter::prefectureHiraganaNameByEnglishName('yamanashi'));
        $this->assertSame('ながのけん', Converter::prefectureHiraganaNameByEnglishName('nagano'));
        $this->assertSame('ぎふけん', Converter::prefectureHiraganaNameByEnglishName('gifu'));
        $this->assertSame('しずおかけん', Converter::prefectureHiraganaNameByEnglishName('shizuoka'));
        $this->assertSame('あいちけん', Converter::prefectureHiraganaNameByEnglishName('aichi'));
        $this->assertSame('みえけん', Converter::prefectureHiraganaNameByEnglishName('mie'));
        $this->assertSame('しがけん', Converter::prefectureHiraganaNameByEnglishName('shiga'));
        $this->assertSame('きょうとふ', Converter::prefectureHiraganaNameByEnglishName('kyoto'));
        $this->assertSame('おおさかふ', Converter::prefectureHiraganaNameByEnglishName('osaka'));
        $this->assertSame('ひょうごけん', Converter::prefectureHiraganaNameByEnglishName('hyogo'));
        $this->assertSame('ならけん', Converter::prefectureHiraganaNameByEnglishName('nara'));
        $this->assertSame('わかやまけん', Converter::prefectureHiraganaNameByEnglishName('wakayama'));
        $this->assertSame('とっとりけん', Converter::prefectureHiraganaNameByEnglishName('tottori'));
        $this->assertSame('しまねけん', Converter::prefectureHiraganaNameByEnglishName('shimane'));
        $this->assertSame('おかやまけん', Converter::prefectureHiraganaNameByEnglishName('okayama'));
        $this->assertSame('ひろしまけん', Converter::prefectureHiraganaNameByEnglishName('hiroshima'));
        $this->assertSame('やまぐちけん', Converter::prefectureHiraganaNameByEnglishName('yamaguchi'));
        $this->assertSame('とくしまけん', Converter::prefectureHiraganaNameByEnglishName('tokushima'));
        $this->assertSame('かがわけん', Converter::prefectureHiraganaNameByEnglishName('kagawa'));
        $this->assertSame('えひめけん', Converter::prefectureHiraganaNameByEnglishName('ehime'));
        $this->assertSame('こうちけん', Converter::prefectureHiraganaNameByEnglishName('kochi'));
        $this->assertSame('ふくおかけん', Converter::prefectureHiraganaNameByEnglishName('fukuoka'));
        $this->assertSame('さがけん', Converter::prefectureHiraganaNameByEnglishName('saga'));
        $this->assertSame('ながさきけん', Converter::prefectureHiraganaNameByEnglishName('nagasaki'));
        $this->assertSame('くまもとけん', Converter::prefectureHiraganaNameByEnglishName('kumamoto'));
        $this->assertSame('おおいたけん', Converter::prefectureHiraganaNameByEnglishName('oita'));
        $this->assertSame('みやざきけん', Converter::prefectureHiraganaNameByEnglishName('miyazaki'));
        $this->assertSame('かごしまけん', Converter::prefectureHiraganaNameByEnglishName('kagoshima'));
        $this->assertSame('おきなわけん', Converter::prefectureHiraganaNameByEnglishName('okinawa'));
        $this->assertNull(Converter::prefectureHiraganaNameByEnglishName('kyotei'));
        $this->assertNull(Converter::prefectureHiraganaNameByEnglishName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureKatakanaNameById(): void
    {
        $this->assertSame('ホッカイドウ', Converter::prefectureKatakanaNameById(1));
        $this->assertSame('アオモリケン', Converter::prefectureKatakanaNameById(2));
        $this->assertSame('イワテケン', Converter::prefectureKatakanaNameById(3));
        $this->assertSame('ミヤギケン', Converter::prefectureKatakanaNameById(4));
        $this->assertSame('アキタケン', Converter::prefectureKatakanaNameById(5));
        $this->assertSame('ヤマガタケン', Converter::prefectureKatakanaNameById(6));
        $this->assertSame('フクシマケン', Converter::prefectureKatakanaNameById(7));
        $this->assertSame('イバラキケン', Converter::prefectureKatakanaNameById(8));
        $this->assertSame('トチギケン', Converter::prefectureKatakanaNameById(9));
        $this->assertSame('グンマケン', Converter::prefectureKatakanaNameById(10));
        $this->assertSame('サイタマケン', Converter::prefectureKatakanaNameById(11));
        $this->assertSame('チバケン', Converter::prefectureKatakanaNameById(12));
        $this->assertSame('トウキョウト', Converter::prefectureKatakanaNameById(13));
        $this->assertSame('カナガワケン', Converter::prefectureKatakanaNameById(14));
        $this->assertSame('ニイガタケン', Converter::prefectureKatakanaNameById(15));
        $this->assertSame('トヤマケン', Converter::prefectureKatakanaNameById(16));
        $this->assertSame('イシカワケン', Converter::prefectureKatakanaNameById(17));
        $this->assertSame('フクイケン', Converter::prefectureKatakanaNameById(18));
        $this->assertSame('ヤマナシケン', Converter::prefectureKatakanaNameById(19));
        $this->assertSame('ナガノケン', Converter::prefectureKatakanaNameById(20));
        $this->assertSame('ギフケン', Converter::prefectureKatakanaNameById(21));
        $this->assertSame('シズオカケン', Converter::prefectureKatakanaNameById(22));
        $this->assertSame('アイチケン', Converter::prefectureKatakanaNameById(23));
        $this->assertSame('ミエケン', Converter::prefectureKatakanaNameById(24));
        $this->assertSame('シガケン', Converter::prefectureKatakanaNameById(25));
        $this->assertSame('キョウトフ', Converter::prefectureKatakanaNameById(26));
        $this->assertSame('オオサカフ', Converter::prefectureKatakanaNameById(27));
        $this->assertSame('ヒョウゴケン', Converter::prefectureKatakanaNameById(28));
        $this->assertSame('ナラケン', Converter::prefectureKatakanaNameById(29));
        $this->assertSame('ワカヤマケン', Converter::prefectureKatakanaNameById(30));
        $this->assertSame('トットリケン', Converter::prefectureKatakanaNameById(31));
        $this->assertSame('シマネケン', Converter::prefectureKatakanaNameById(32));
        $this->assertSame('オカヤマケン', Converter::prefectureKatakanaNameById(33));
        $this->assertSame('ヒロシマケン', Converter::prefectureKatakanaNameById(34));
        $this->assertSame('ヤマグチケン', Converter::prefectureKatakanaNameById(35));
        $this->assertSame('トクシマケン', Converter::prefectureKatakanaNameById(36));
        $this->assertSame('カガワケン', Converter::prefectureKatakanaNameById(37));
        $this->assertSame('エヒメケン', Converter::prefectureKatakanaNameById(38));
        $this->assertSame('コウチケン', Converter::prefectureKatakanaNameById(39));
        $this->assertSame('フクオカケン', Converter::prefectureKatakanaNameById(40));
        $this->assertSame('サガケン', Converter::prefectureKatakanaNameById(41));
        $this->assertSame('ナガサキケン', Converter::prefectureKatakanaNameById(42));
        $this->assertSame('クマモトケン', Converter::prefectureKatakanaNameById(43));
        $this->assertSame('オオイタケン', Converter::prefectureKatakanaNameById(44));
        $this->assertSame('ミヤザキケン', Converter::prefectureKatakanaNameById(45));
        $this->assertSame('カゴシマケン', Converter::prefectureKatakanaNameById(46));
        $this->assertSame('オキナワケン', Converter::prefectureKatakanaNameById(47));
        $this->assertNull(Converter::prefectureKatakanaNameById(48));
        $this->assertNull(Converter::prefectureKatakanaNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureKatakanaNameByName(): void
    {
        $this->assertSame('ホッカイドウ', Converter::prefectureKatakanaNameByName('北海道'));
        $this->assertSame('アオモリケン', Converter::prefectureKatakanaNameByName('青森県'));
        $this->assertSame('イワテケン', Converter::prefectureKatakanaNameByName('岩手県'));
        $this->assertSame('ミヤギケン', Converter::prefectureKatakanaNameByName('宮城県'));
        $this->assertSame('アキタケン', Converter::prefectureKatakanaNameByName('秋田県'));
        $this->assertSame('ヤマガタケン', Converter::prefectureKatakanaNameByName('山形県'));
        $this->assertSame('フクシマケン', Converter::prefectureKatakanaNameByName('福島県'));
        $this->assertSame('イバラキケン', Converter::prefectureKatakanaNameByName('茨城県'));
        $this->assertSame('トチギケン', Converter::prefectureKatakanaNameByName('栃木県'));
        $this->assertSame('グンマケン', Converter::prefectureKatakanaNameByName('群馬県'));
        $this->assertSame('サイタマケン', Converter::prefectureKatakanaNameByName('埼玉県'));
        $this->assertSame('チバケン', Converter::prefectureKatakanaNameByName('千葉県'));
        $this->assertSame('トウキョウト', Converter::prefectureKatakanaNameByName('東京都'));
        $this->assertSame('カナガワケン', Converter::prefectureKatakanaNameByName('神奈川県'));
        $this->assertSame('ニイガタケン', Converter::prefectureKatakanaNameByName('新潟県'));
        $this->assertSame('トヤマケン', Converter::prefectureKatakanaNameByName('富山県'));
        $this->assertSame('イシカワケン', Converter::prefectureKatakanaNameByName('石川県'));
        $this->assertSame('フクイケン', Converter::prefectureKatakanaNameByName('福井県'));
        $this->assertSame('ヤマナシケン', Converter::prefectureKatakanaNameByName('山梨県'));
        $this->assertSame('ナガノケン', Converter::prefectureKatakanaNameByName('長野県'));
        $this->assertSame('ギフケン', Converter::prefectureKatakanaNameByName('岐阜県'));
        $this->assertSame('シズオカケン', Converter::prefectureKatakanaNameByName('静岡県'));
        $this->assertSame('アイチケン', Converter::prefectureKatakanaNameByName('愛知県'));
        $this->assertSame('ミエケン', Converter::prefectureKatakanaNameByName('三重県'));
        $this->assertSame('シガケン', Converter::prefectureKatakanaNameByName('滋賀県'));
        $this->assertSame('キョウトフ', Converter::prefectureKatakanaNameByName('京都府'));
        $this->assertSame('オオサカフ', Converter::prefectureKatakanaNameByName('大阪府'));
        $this->assertSame('ヒョウゴケン', Converter::prefectureKatakanaNameByName('兵庫県'));
        $this->assertSame('ナラケン', Converter::prefectureKatakanaNameByName('奈良県'));
        $this->assertSame('ワカヤマケン', Converter::prefectureKatakanaNameByName('和歌山県'));
        $this->assertSame('トットリケン', Converter::prefectureKatakanaNameByName('鳥取県'));
        $this->assertSame('シマネケン', Converter::prefectureKatakanaNameByName('島根県'));
        $this->assertSame('オカヤマケン', Converter::prefectureKatakanaNameByName('岡山県'));
        $this->assertSame('ヒロシマケン', Converter::prefectureKatakanaNameByName('広島県'));
        $this->assertSame('ヤマグチケン', Converter::prefectureKatakanaNameByName('山口県'));
        $this->assertSame('トクシマケン', Converter::prefectureKatakanaNameByName('徳島県'));
        $this->assertSame('カガワケン', Converter::prefectureKatakanaNameByName('香川県'));
        $this->assertSame('エヒメケン', Converter::prefectureKatakanaNameByName('愛媛県'));
        $this->assertSame('コウチケン', Converter::prefectureKatakanaNameByName('高知県'));
        $this->assertSame('フクオカケン', Converter::prefectureKatakanaNameByName('福岡県'));
        $this->assertSame('サガケン', Converter::prefectureKatakanaNameByName('佐賀県'));
        $this->assertSame('ナガサキケン', Converter::prefectureKatakanaNameByName('長崎県'));
        $this->assertSame('クマモトケン', Converter::prefectureKatakanaNameByName('熊本県'));
        $this->assertSame('オオイタケン', Converter::prefectureKatakanaNameByName('大分県'));
        $this->assertSame('ミヤザキケン', Converter::prefectureKatakanaNameByName('宮崎県'));
        $this->assertSame('カゴシマケン', Converter::prefectureKatakanaNameByName('鹿児島県'));
        $this->assertSame('オキナワケン', Converter::prefectureKatakanaNameByName('沖縄県'));
        $this->assertNull(Converter::prefectureKatakanaNameByName('競艇'));
        $this->assertNull(Converter::prefectureKatakanaNameByName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureKatakanaNameByShortName(): void
    {
        $this->assertSame('ホッカイドウ', Converter::prefectureKatakanaNameByShortName('北海道'));
        $this->assertSame('アオモリケン', Converter::prefectureKatakanaNameByShortName('青森'));
        $this->assertSame('イワテケン', Converter::prefectureKatakanaNameByShortName('岩手'));
        $this->assertSame('ミヤギケン', Converter::prefectureKatakanaNameByShortName('宮城'));
        $this->assertSame('アキタケン', Converter::prefectureKatakanaNameByShortName('秋田'));
        $this->assertSame('ヤマガタケン', Converter::prefectureKatakanaNameByShortName('山形'));
        $this->assertSame('フクシマケン', Converter::prefectureKatakanaNameByShortName('福島'));
        $this->assertSame('イバラキケン', Converter::prefectureKatakanaNameByShortName('茨城'));
        $this->assertSame('トチギケン', Converter::prefectureKatakanaNameByShortName('栃木'));
        $this->assertSame('グンマケン', Converter::prefectureKatakanaNameByShortName('群馬'));
        $this->assertSame('サイタマケン', Converter::prefectureKatakanaNameByShortName('埼玉'));
        $this->assertSame('チバケン', Converter::prefectureKatakanaNameByShortName('千葉'));
        $this->assertSame('トウキョウト', Converter::prefectureKatakanaNameByShortName('東京'));
        $this->assertSame('カナガワケン', Converter::prefectureKatakanaNameByShortName('神奈川'));
        $this->assertSame('ニイガタケン', Converter::prefectureKatakanaNameByShortName('新潟'));
        $this->assertSame('トヤマケン', Converter::prefectureKatakanaNameByShortName('富山'));
        $this->assertSame('イシカワケン', Converter::prefectureKatakanaNameByShortName('石川'));
        $this->assertSame('フクイケン', Converter::prefectureKatakanaNameByShortName('福井'));
        $this->assertSame('ヤマナシケン', Converter::prefectureKatakanaNameByShortName('山梨'));
        $this->assertSame('ナガノケン', Converter::prefectureKatakanaNameByShortName('長野'));
        $this->assertSame('ギフケン', Converter::prefectureKatakanaNameByShortName('岐阜'));
        $this->assertSame('シズオカケン', Converter::prefectureKatakanaNameByShortName('静岡'));
        $this->assertSame('アイチケン', Converter::prefectureKatakanaNameByShortName('愛知'));
        $this->assertSame('ミエケン', Converter::prefectureKatakanaNameByShortName('三重'));
        $this->assertSame('シガケン', Converter::prefectureKatakanaNameByShortName('滋賀'));
        $this->assertSame('キョウトフ', Converter::prefectureKatakanaNameByShortName('京都'));
        $this->assertSame('オオサカフ', Converter::prefectureKatakanaNameByShortName('大阪'));
        $this->assertSame('ヒョウゴケン', Converter::prefectureKatakanaNameByShortName('兵庫'));
        $this->assertSame('ナラケン', Converter::prefectureKatakanaNameByShortName('奈良'));
        $this->assertSame('ワカヤマケン', Converter::prefectureKatakanaNameByShortName('和歌山'));
        $this->assertSame('トットリケン', Converter::prefectureKatakanaNameByShortName('鳥取'));
        $this->assertSame('シマネケン', Converter::prefectureKatakanaNameByShortName('島根'));
        $this->assertSame('オカヤマケン', Converter::prefectureKatakanaNameByShortName('岡山'));
        $this->assertSame('ヒロシマケン', Converter::prefectureKatakanaNameByShortName('広島'));
        $this->assertSame('ヤマグチケン', Converter::prefectureKatakanaNameByShortName('山口'));
        $this->assertSame('トクシマケン', Converter::prefectureKatakanaNameByShortName('徳島'));
        $this->assertSame('カガワケン', Converter::prefectureKatakanaNameByShortName('香川'));
        $this->assertSame('エヒメケン', Converter::prefectureKatakanaNameByShortName('愛媛'));
        $this->assertSame('コウチケン', Converter::prefectureKatakanaNameByShortName('高知'));
        $this->assertSame('フクオカケン', Converter::prefectureKatakanaNameByShortName('福岡'));
        $this->assertSame('サガケン', Converter::prefectureKatakanaNameByShortName('佐賀'));
        $this->assertSame('ナガサキケン', Converter::prefectureKatakanaNameByShortName('長崎'));
        $this->assertSame('クマモトケン', Converter::prefectureKatakanaNameByShortName('熊本'));
        $this->assertSame('オオイタケン', Converter::prefectureKatakanaNameByShortName('大分'));
        $this->assertSame('ミヤザキケン', Converter::prefectureKatakanaNameByShortName('宮崎'));
        $this->assertSame('カゴシマケン', Converter::prefectureKatakanaNameByShortName('鹿児島'));
        $this->assertSame('オキナワケン', Converter::prefectureKatakanaNameByShortName('沖縄'));
        $this->assertNull(Converter::prefectureKatakanaNameByShortName('競艇'));
        $this->assertNull(Converter::prefectureKatakanaNameByShortName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureKatakanaNameByHiraganaName(): void
    {
        $this->assertSame('ホッカイドウ', Converter::prefectureKatakanaNameByHiraganaName('ほっかいどう'));
        $this->assertSame('アオモリケン', Converter::prefectureKatakanaNameByHiraganaName('あおもりけん'));
        $this->assertSame('イワテケン', Converter::prefectureKatakanaNameByHiraganaName('いわてけん'));
        $this->assertSame('ミヤギケン', Converter::prefectureKatakanaNameByHiraganaName('みやぎけん'));
        $this->assertSame('アキタケン', Converter::prefectureKatakanaNameByHiraganaName('あきたけん'));
        $this->assertSame('ヤマガタケン', Converter::prefectureKatakanaNameByHiraganaName('やまがたけん'));
        $this->assertSame('フクシマケン', Converter::prefectureKatakanaNameByHiraganaName('ふくしまけん'));
        $this->assertSame('イバラキケン', Converter::prefectureKatakanaNameByHiraganaName('いばらきけん'));
        $this->assertSame('トチギケン', Converter::prefectureKatakanaNameByHiraganaName('とちぎけん'));
        $this->assertSame('グンマケン', Converter::prefectureKatakanaNameByHiraganaName('ぐんまけん'));
        $this->assertSame('サイタマケン', Converter::prefectureKatakanaNameByHiraganaName('さいたまけん'));
        $this->assertSame('チバケン', Converter::prefectureKatakanaNameByHiraganaName('ちばけん'));
        $this->assertSame('トウキョウト', Converter::prefectureKatakanaNameByHiraganaName('とうきょうと'));
        $this->assertSame('カナガワケン', Converter::prefectureKatakanaNameByHiraganaName('かながわけん'));
        $this->assertSame('ニイガタケン', Converter::prefectureKatakanaNameByHiraganaName('にいがたけん'));
        $this->assertSame('トヤマケン', Converter::prefectureKatakanaNameByHiraganaName('とやまけん'));
        $this->assertSame('イシカワケン', Converter::prefectureKatakanaNameByHiraganaName('いしかわけん'));
        $this->assertSame('フクイケン', Converter::prefectureKatakanaNameByHiraganaName('ふくいけん'));
        $this->assertSame('ヤマナシケン', Converter::prefectureKatakanaNameByHiraganaName('やまなしけん'));
        $this->assertSame('ナガノケン', Converter::prefectureKatakanaNameByHiraganaName('ながのけん'));
        $this->assertSame('ギフケン', Converter::prefectureKatakanaNameByHiraganaName('ぎふけん'));
        $this->assertSame('シズオカケン', Converter::prefectureKatakanaNameByHiraganaName('しずおかけん'));
        $this->assertSame('アイチケン', Converter::prefectureKatakanaNameByHiraganaName('あいちけん'));
        $this->assertSame('ミエケン', Converter::prefectureKatakanaNameByHiraganaName('みえけん'));
        $this->assertSame('シガケン', Converter::prefectureKatakanaNameByHiraganaName('しがけん'));
        $this->assertSame('キョウトフ', Converter::prefectureKatakanaNameByHiraganaName('きょうとふ'));
        $this->assertSame('オオサカフ', Converter::prefectureKatakanaNameByHiraganaName('おおさかふ'));
        $this->assertSame('ヒョウゴケン', Converter::prefectureKatakanaNameByHiraganaName('ひょうごけん'));
        $this->assertSame('ナラケン', Converter::prefectureKatakanaNameByHiraganaName('ならけん'));
        $this->assertSame('ワカヤマケン', Converter::prefectureKatakanaNameByHiraganaName('わかやまけん'));
        $this->assertSame('トットリケン', Converter::prefectureKatakanaNameByHiraganaName('とっとりけん'));
        $this->assertSame('シマネケン', Converter::prefectureKatakanaNameByHiraganaName('しまねけん'));
        $this->assertSame('オカヤマケン', Converter::prefectureKatakanaNameByHiraganaName('おかやまけん'));
        $this->assertSame('ヒロシマケン', Converter::prefectureKatakanaNameByHiraganaName('ひろしまけん'));
        $this->assertSame('ヤマグチケン', Converter::prefectureKatakanaNameByHiraganaName('やまぐちけん'));
        $this->assertSame('トクシマケン', Converter::prefectureKatakanaNameByHiraganaName('とくしまけん'));
        $this->assertSame('カガワケン', Converter::prefectureKatakanaNameByHiraganaName('かがわけん'));
        $this->assertSame('エヒメケン', Converter::prefectureKatakanaNameByHiraganaName('えひめけん'));
        $this->assertSame('コウチケン', Converter::prefectureKatakanaNameByHiraganaName('こうちけん'));
        $this->assertSame('フクオカケン', Converter::prefectureKatakanaNameByHiraganaName('ふくおかけん'));
        $this->assertSame('サガケン', Converter::prefectureKatakanaNameByHiraganaName('さがけん'));
        $this->assertSame('ナガサキケン', Converter::prefectureKatakanaNameByHiraganaName('ながさきけん'));
        $this->assertSame('クマモトケン', Converter::prefectureKatakanaNameByHiraganaName('くまもとけん'));
        $this->assertSame('オオイタケン', Converter::prefectureKatakanaNameByHiraganaName('おおいたけん'));
        $this->assertSame('ミヤザキケン', Converter::prefectureKatakanaNameByHiraganaName('みやざきけん'));
        $this->assertSame('カゴシマケン', Converter::prefectureKatakanaNameByHiraganaName('かごしまけん'));
        $this->assertSame('オキナワケン', Converter::prefectureKatakanaNameByHiraganaName('おきなわけん'));
        $this->assertNull(Converter::prefectureKatakanaNameByHiraganaName('きょうてい'));
        $this->assertNull(Converter::prefectureKatakanaNameByHiraganaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureKatakanaNameByEnglishName(): void
    {
        $this->assertSame('ホッカイドウ', Converter::prefectureKatakanaNameByEnglishName('hokkaido'));
        $this->assertSame('アオモリケン', Converter::prefectureKatakanaNameByEnglishName('aomori'));
        $this->assertSame('イワテケン', Converter::prefectureKatakanaNameByEnglishName('iwate'));
        $this->assertSame('ミヤギケン', Converter::prefectureKatakanaNameByEnglishName('miyagi'));
        $this->assertSame('アキタケン', Converter::prefectureKatakanaNameByEnglishName('akita'));
        $this->assertSame('ヤマガタケン', Converter::prefectureKatakanaNameByEnglishName('yamagata'));
        $this->assertSame('フクシマケン', Converter::prefectureKatakanaNameByEnglishName('fukushima'));
        $this->assertSame('イバラキケン', Converter::prefectureKatakanaNameByEnglishName('ibaraki'));
        $this->assertSame('トチギケン', Converter::prefectureKatakanaNameByEnglishName('tochigi'));
        $this->assertSame('グンマケン', Converter::prefectureKatakanaNameByEnglishName('gunma'));
        $this->assertSame('サイタマケン', Converter::prefectureKatakanaNameByEnglishName('saitama'));
        $this->assertSame('チバケン', Converter::prefectureKatakanaNameByEnglishName('chiba'));
        $this->assertSame('トウキョウト', Converter::prefectureKatakanaNameByEnglishName('tokyo'));
        $this->assertSame('カナガワケン', Converter::prefectureKatakanaNameByEnglishName('kanagawa'));
        $this->assertSame('ニイガタケン', Converter::prefectureKatakanaNameByEnglishName('niigata'));
        $this->assertSame('トヤマケン', Converter::prefectureKatakanaNameByEnglishName('toyama'));
        $this->assertSame('イシカワケン', Converter::prefectureKatakanaNameByEnglishName('ishikawa'));
        $this->assertSame('フクイケン', Converter::prefectureKatakanaNameByEnglishName('fukui'));
        $this->assertSame('ヤマナシケン', Converter::prefectureKatakanaNameByEnglishName('yamanashi'));
        $this->assertSame('ナガノケン', Converter::prefectureKatakanaNameByEnglishName('nagano'));
        $this->assertSame('ギフケン', Converter::prefectureKatakanaNameByEnglishName('gifu'));
        $this->assertSame('シズオカケン', Converter::prefectureKatakanaNameByEnglishName('shizuoka'));
        $this->assertSame('アイチケン', Converter::prefectureKatakanaNameByEnglishName('aichi'));
        $this->assertSame('ミエケン', Converter::prefectureKatakanaNameByEnglishName('mie'));
        $this->assertSame('シガケン', Converter::prefectureKatakanaNameByEnglishName('shiga'));
        $this->assertSame('キョウトフ', Converter::prefectureKatakanaNameByEnglishName('kyoto'));
        $this->assertSame('オオサカフ', Converter::prefectureKatakanaNameByEnglishName('osaka'));
        $this->assertSame('ヒョウゴケン', Converter::prefectureKatakanaNameByEnglishName('hyogo'));
        $this->assertSame('ナラケン', Converter::prefectureKatakanaNameByEnglishName('nara'));
        $this->assertSame('ワカヤマケン', Converter::prefectureKatakanaNameByEnglishName('wakayama'));
        $this->assertSame('トットリケン', Converter::prefectureKatakanaNameByEnglishName('tottori'));
        $this->assertSame('シマネケン', Converter::prefectureKatakanaNameByEnglishName('shimane'));
        $this->assertSame('オカヤマケン', Converter::prefectureKatakanaNameByEnglishName('okayama'));
        $this->assertSame('ヒロシマケン', Converter::prefectureKatakanaNameByEnglishName('hiroshima'));
        $this->assertSame('ヤマグチケン', Converter::prefectureKatakanaNameByEnglishName('yamaguchi'));
        $this->assertSame('トクシマケン', Converter::prefectureKatakanaNameByEnglishName('tokushima'));
        $this->assertSame('カガワケン', Converter::prefectureKatakanaNameByEnglishName('kagawa'));
        $this->assertSame('エヒメケン', Converter::prefectureKatakanaNameByEnglishName('ehime'));
        $this->assertSame('コウチケン', Converter::prefectureKatakanaNameByEnglishName('kochi'));
        $this->assertSame('フクオカケン', Converter::prefectureKatakanaNameByEnglishName('fukuoka'));
        $this->assertSame('サガケン', Converter::prefectureKatakanaNameByEnglishName('saga'));
        $this->assertSame('ナガサキケン', Converter::prefectureKatakanaNameByEnglishName('nagasaki'));
        $this->assertSame('クマモトケン', Converter::prefectureKatakanaNameByEnglishName('kumamoto'));
        $this->assertSame('オオイタケン', Converter::prefectureKatakanaNameByEnglishName('oita'));
        $this->assertSame('ミヤザキケン', Converter::prefectureKatakanaNameByEnglishName('miyazaki'));
        $this->assertSame('カゴシマケン', Converter::prefectureKatakanaNameByEnglishName('kagoshima'));
        $this->assertSame('オキナワケン', Converter::prefectureKatakanaNameByEnglishName('okinawa'));
        $this->assertNull(Converter::prefectureKatakanaNameByEnglishName('kyotei'));
        $this->assertNull(Converter::prefectureKatakanaNameByEnglishName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureEnglishNameById(): void
    {
        $this->assertSame('hokkaido', Converter::prefectureEnglishNameById(1));
        $this->assertSame('aomori', Converter::prefectureEnglishNameById(2));
        $this->assertSame('iwate', Converter::prefectureEnglishNameById(3));
        $this->assertSame('miyagi', Converter::prefectureEnglishNameById(4));
        $this->assertSame('akita', Converter::prefectureEnglishNameById(5));
        $this->assertSame('yamagata', Converter::prefectureEnglishNameById(6));
        $this->assertSame('fukushima', Converter::prefectureEnglishNameById(7));
        $this->assertSame('ibaraki', Converter::prefectureEnglishNameById(8));
        $this->assertSame('tochigi', Converter::prefectureEnglishNameById(9));
        $this->assertSame('gunma', Converter::prefectureEnglishNameById(10));
        $this->assertSame('saitama', Converter::prefectureEnglishNameById(11));
        $this->assertSame('chiba', Converter::prefectureEnglishNameById(12));
        $this->assertSame('tokyo', Converter::prefectureEnglishNameById(13));
        $this->assertSame('kanagawa', Converter::prefectureEnglishNameById(14));
        $this->assertSame('niigata', Converter::prefectureEnglishNameById(15));
        $this->assertSame('toyama', Converter::prefectureEnglishNameById(16));
        $this->assertSame('ishikawa', Converter::prefectureEnglishNameById(17));
        $this->assertSame('fukui', Converter::prefectureEnglishNameById(18));
        $this->assertSame('yamanashi', Converter::prefectureEnglishNameById(19));
        $this->assertSame('nagano', Converter::prefectureEnglishNameById(20));
        $this->assertSame('gifu', Converter::prefectureEnglishNameById(21));
        $this->assertSame('shizuoka', Converter::prefectureEnglishNameById(22));
        $this->assertSame('aichi', Converter::prefectureEnglishNameById(23));
        $this->assertSame('mie', Converter::prefectureEnglishNameById(24));
        $this->assertSame('shiga', Converter::prefectureEnglishNameById(25));
        $this->assertSame('kyoto', Converter::prefectureEnglishNameById(26));
        $this->assertSame('osaka', Converter::prefectureEnglishNameById(27));
        $this->assertSame('hyogo', Converter::prefectureEnglishNameById(28));
        $this->assertSame('nara', Converter::prefectureEnglishNameById(29));
        $this->assertSame('wakayama', Converter::prefectureEnglishNameById(30));
        $this->assertSame('tottori', Converter::prefectureEnglishNameById(31));
        $this->assertSame('shimane', Converter::prefectureEnglishNameById(32));
        $this->assertSame('okayama', Converter::prefectureEnglishNameById(33));
        $this->assertSame('hiroshima', Converter::prefectureEnglishNameById(34));
        $this->assertSame('yamaguchi', Converter::prefectureEnglishNameById(35));
        $this->assertSame('tokushima', Converter::prefectureEnglishNameById(36));
        $this->assertSame('kagawa', Converter::prefectureEnglishNameById(37));
        $this->assertSame('ehime', Converter::prefectureEnglishNameById(38));
        $this->assertSame('kochi', Converter::prefectureEnglishNameById(39));
        $this->assertSame('fukuoka', Converter::prefectureEnglishNameById(40));
        $this->assertSame('saga', Converter::prefectureEnglishNameById(41));
        $this->assertSame('nagasaki', Converter::prefectureEnglishNameById(42));
        $this->assertSame('kumamoto', Converter::prefectureEnglishNameById(43));
        $this->assertSame('oita', Converter::prefectureEnglishNameById(44));
        $this->assertSame('miyazaki', Converter::prefectureEnglishNameById(45));
        $this->assertSame('kagoshima', Converter::prefectureEnglishNameById(46));
        $this->assertSame('okinawa', Converter::prefectureEnglishNameById(47));
        $this->assertNull(Converter::prefectureEnglishNameById(48));
        $this->assertNull(Converter::prefectureEnglishNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureEnglishNameByName(): void
    {
        $this->assertSame('hokkaido', Converter::prefectureEnglishNameByName('北海道'));
        $this->assertSame('aomori', Converter::prefectureEnglishNameByName('青森県'));
        $this->assertSame('iwate', Converter::prefectureEnglishNameByName('岩手県'));
        $this->assertSame('miyagi', Converter::prefectureEnglishNameByName('宮城県'));
        $this->assertSame('akita', Converter::prefectureEnglishNameByName('秋田県'));
        $this->assertSame('yamagata', Converter::prefectureEnglishNameByName('山形県'));
        $this->assertSame('fukushima', Converter::prefectureEnglishNameByName('福島県'));
        $this->assertSame('ibaraki', Converter::prefectureEnglishNameByName('茨城県'));
        $this->assertSame('tochigi', Converter::prefectureEnglishNameByName('栃木県'));
        $this->assertSame('gunma', Converter::prefectureEnglishNameByName('群馬県'));
        $this->assertSame('saitama', Converter::prefectureEnglishNameByName('埼玉県'));
        $this->assertSame('chiba', Converter::prefectureEnglishNameByName('千葉県'));
        $this->assertSame('tokyo', Converter::prefectureEnglishNameByName('東京都'));
        $this->assertSame('kanagawa', Converter::prefectureEnglishNameByName('神奈川県'));
        $this->assertSame('niigata', Converter::prefectureEnglishNameByName('新潟県'));
        $this->assertSame('toyama', Converter::prefectureEnglishNameByName('富山県'));
        $this->assertSame('ishikawa', Converter::prefectureEnglishNameByName('石川県'));
        $this->assertSame('fukui', Converter::prefectureEnglishNameByName('福井県'));
        $this->assertSame('yamanashi', Converter::prefectureEnglishNameByName('山梨県'));
        $this->assertSame('nagano', Converter::prefectureEnglishNameByName('長野県'));
        $this->assertSame('gifu', Converter::prefectureEnglishNameByName('岐阜県'));
        $this->assertSame('shizuoka', Converter::prefectureEnglishNameByName('静岡県'));
        $this->assertSame('aichi', Converter::prefectureEnglishNameByName('愛知県'));
        $this->assertSame('mie', Converter::prefectureEnglishNameByName('三重県'));
        $this->assertSame('shiga', Converter::prefectureEnglishNameByName('滋賀県'));
        $this->assertSame('kyoto', Converter::prefectureEnglishNameByName('京都府'));
        $this->assertSame('osaka', Converter::prefectureEnglishNameByName('大阪府'));
        $this->assertSame('hyogo', Converter::prefectureEnglishNameByName('兵庫県'));
        $this->assertSame('nara', Converter::prefectureEnglishNameByName('奈良県'));
        $this->assertSame('wakayama', Converter::prefectureEnglishNameByName('和歌山県'));
        $this->assertSame('tottori', Converter::prefectureEnglishNameByName('鳥取県'));
        $this->assertSame('shimane', Converter::prefectureEnglishNameByName('島根県'));
        $this->assertSame('okayama', Converter::prefectureEnglishNameByName('岡山県'));
        $this->assertSame('hiroshima', Converter::prefectureEnglishNameByName('広島県'));
        $this->assertSame('yamaguchi', Converter::prefectureEnglishNameByName('山口県'));
        $this->assertSame('tokushima', Converter::prefectureEnglishNameByName('徳島県'));
        $this->assertSame('kagawa', Converter::prefectureEnglishNameByName('香川県'));
        $this->assertSame('ehime', Converter::prefectureEnglishNameByName('愛媛県'));
        $this->assertSame('kochi', Converter::prefectureEnglishNameByName('高知県'));
        $this->assertSame('fukuoka', Converter::prefectureEnglishNameByName('福岡県'));
        $this->assertSame('saga', Converter::prefectureEnglishNameByName('佐賀県'));
        $this->assertSame('nagasaki', Converter::prefectureEnglishNameByName('長崎県'));
        $this->assertSame('kumamoto', Converter::prefectureEnglishNameByName('熊本県'));
        $this->assertSame('oita', Converter::prefectureEnglishNameByName('大分県'));
        $this->assertSame('miyazaki', Converter::prefectureEnglishNameByName('宮崎県'));
        $this->assertSame('kagoshima', Converter::prefectureEnglishNameByName('鹿児島県'));
        $this->assertSame('okinawa', Converter::prefectureEnglishNameByName('沖縄県'));
        $this->assertNull(Converter::prefectureEnglishNameByName('競艇'));
        $this->assertNull(Converter::prefectureEnglishNameByName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureEnglishNameByShortName(): void
    {
        $this->assertSame('hokkaido', Converter::prefectureEnglishNameByShortName('北海道'));
        $this->assertSame('aomori', Converter::prefectureEnglishNameByShortName('青森'));
        $this->assertSame('iwate', Converter::prefectureEnglishNameByShortName('岩手'));
        $this->assertSame('miyagi', Converter::prefectureEnglishNameByShortName('宮城'));
        $this->assertSame('akita', Converter::prefectureEnglishNameByShortName('秋田'));
        $this->assertSame('yamagata', Converter::prefectureEnglishNameByShortName('山形'));
        $this->assertSame('fukushima', Converter::prefectureEnglishNameByShortName('福島'));
        $this->assertSame('ibaraki', Converter::prefectureEnglishNameByShortName('茨城'));
        $this->assertSame('tochigi', Converter::prefectureEnglishNameByShortName('栃木'));
        $this->assertSame('gunma', Converter::prefectureEnglishNameByShortName('群馬'));
        $this->assertSame('saitama', Converter::prefectureEnglishNameByShortName('埼玉'));
        $this->assertSame('chiba', Converter::prefectureEnglishNameByShortName('千葉'));
        $this->assertSame('tokyo', Converter::prefectureEnglishNameByShortName('東京'));
        $this->assertSame('kanagawa', Converter::prefectureEnglishNameByShortName('神奈川'));
        $this->assertSame('niigata', Converter::prefectureEnglishNameByShortName('新潟'));
        $this->assertSame('toyama', Converter::prefectureEnglishNameByShortName('富山'));
        $this->assertSame('ishikawa', Converter::prefectureEnglishNameByShortName('石川'));
        $this->assertSame('fukui', Converter::prefectureEnglishNameByShortName('福井'));
        $this->assertSame('yamanashi', Converter::prefectureEnglishNameByShortName('山梨'));
        $this->assertSame('nagano', Converter::prefectureEnglishNameByShortName('長野'));
        $this->assertSame('gifu', Converter::prefectureEnglishNameByShortName('岐阜'));
        $this->assertSame('shizuoka', Converter::prefectureEnglishNameByShortName('静岡'));
        $this->assertSame('aichi', Converter::prefectureEnglishNameByShortName('愛知'));
        $this->assertSame('mie', Converter::prefectureEnglishNameByShortName('三重'));
        $this->assertSame('shiga', Converter::prefectureEnglishNameByShortName('滋賀'));
        $this->assertSame('kyoto', Converter::prefectureEnglishNameByShortName('京都'));
        $this->assertSame('osaka', Converter::prefectureEnglishNameByShortName('大阪'));
        $this->assertSame('hyogo', Converter::prefectureEnglishNameByShortName('兵庫'));
        $this->assertSame('nara', Converter::prefectureEnglishNameByShortName('奈良'));
        $this->assertSame('wakayama', Converter::prefectureEnglishNameByShortName('和歌山'));
        $this->assertSame('tottori', Converter::prefectureEnglishNameByShortName('鳥取'));
        $this->assertSame('shimane', Converter::prefectureEnglishNameByShortName('島根'));
        $this->assertSame('okayama', Converter::prefectureEnglishNameByShortName('岡山'));
        $this->assertSame('hiroshima', Converter::prefectureEnglishNameByShortName('広島'));
        $this->assertSame('yamaguchi', Converter::prefectureEnglishNameByShortName('山口'));
        $this->assertSame('tokushima', Converter::prefectureEnglishNameByShortName('徳島'));
        $this->assertSame('kagawa', Converter::prefectureEnglishNameByShortName('香川'));
        $this->assertSame('ehime', Converter::prefectureEnglishNameByShortName('愛媛'));
        $this->assertSame('kochi', Converter::prefectureEnglishNameByShortName('高知'));
        $this->assertSame('fukuoka', Converter::prefectureEnglishNameByShortName('福岡'));
        $this->assertSame('saga', Converter::prefectureEnglishNameByShortName('佐賀'));
        $this->assertSame('nagasaki', Converter::prefectureEnglishNameByShortName('長崎'));
        $this->assertSame('kumamoto', Converter::prefectureEnglishNameByShortName('熊本'));
        $this->assertSame('oita', Converter::prefectureEnglishNameByShortName('大分'));
        $this->assertSame('miyazaki', Converter::prefectureEnglishNameByShortName('宮崎'));
        $this->assertSame('kagoshima', Converter::prefectureEnglishNameByShortName('鹿児島'));
        $this->assertSame('okinawa', Converter::prefectureEnglishNameByShortName('沖縄'));
        $this->assertNull(Converter::prefectureEnglishNameByShortName('kyotei'));
        $this->assertNull(Converter::prefectureEnglishNameByShortName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureEnglishNameByHiraganaName(): void
    {
        $this->assertSame('hokkaido', Converter::prefectureEnglishNameByHiraganaName('ほっかいどう'));
        $this->assertSame('aomori', Converter::prefectureEnglishNameByHiraganaName('あおもりけん'));
        $this->assertSame('iwate', Converter::prefectureEnglishNameByHiraganaName('いわてけん'));
        $this->assertSame('miyagi', Converter::prefectureEnglishNameByHiraganaName('みやぎけん'));
        $this->assertSame('akita', Converter::prefectureEnglishNameByHiraganaName('あきたけん'));
        $this->assertSame('yamagata', Converter::prefectureEnglishNameByHiraganaName('やまがたけん'));
        $this->assertSame('fukushima', Converter::prefectureEnglishNameByHiraganaName('ふくしまけん'));
        $this->assertSame('ibaraki', Converter::prefectureEnglishNameByHiraganaName('いばらきけん'));
        $this->assertSame('tochigi', Converter::prefectureEnglishNameByHiraganaName('とちぎけん'));
        $this->assertSame('gunma', Converter::prefectureEnglishNameByHiraganaName('ぐんまけん'));
        $this->assertSame('saitama', Converter::prefectureEnglishNameByHiraganaName('さいたまけん'));
        $this->assertSame('chiba', Converter::prefectureEnglishNameByHiraganaName('ちばけん'));
        $this->assertSame('tokyo', Converter::prefectureEnglishNameByHiraganaName('とうきょうと'));
        $this->assertSame('kanagawa', Converter::prefectureEnglishNameByHiraganaName('かながわけん'));
        $this->assertSame('niigata', Converter::prefectureEnglishNameByHiraganaName('にいがたけん'));
        $this->assertSame('toyama', Converter::prefectureEnglishNameByHiraganaName('とやまけん'));
        $this->assertSame('ishikawa', Converter::prefectureEnglishNameByHiraganaName('いしかわけん'));
        $this->assertSame('fukui', Converter::prefectureEnglishNameByHiraganaName('ふくいけん'));
        $this->assertSame('yamanashi', Converter::prefectureEnglishNameByHiraganaName('やまなしけん'));
        $this->assertSame('nagano', Converter::prefectureEnglishNameByHiraganaName('ながのけん'));
        $this->assertSame('gifu', Converter::prefectureEnglishNameByHiraganaName('ぎふけん'));
        $this->assertSame('shizuoka', Converter::prefectureEnglishNameByHiraganaName('しずおかけん'));
        $this->assertSame('aichi', Converter::prefectureEnglishNameByHiraganaName('あいちけん'));
        $this->assertSame('mie', Converter::prefectureEnglishNameByHiraganaName('みえけん'));
        $this->assertSame('shiga', Converter::prefectureEnglishNameByHiraganaName('しがけん'));
        $this->assertSame('kyoto', Converter::prefectureEnglishNameByHiraganaName('きょうとふ'));
        $this->assertSame('osaka', Converter::prefectureEnglishNameByHiraganaName('おおさかふ'));
        $this->assertSame('hyogo', Converter::prefectureEnglishNameByHiraganaName('ひょうごけん'));
        $this->assertSame('nara', Converter::prefectureEnglishNameByHiraganaName('ならけん'));
        $this->assertSame('wakayama', Converter::prefectureEnglishNameByHiraganaName('わかやまけん'));
        $this->assertSame('tottori', Converter::prefectureEnglishNameByHiraganaName('とっとりけん'));
        $this->assertSame('shimane', Converter::prefectureEnglishNameByHiraganaName('しまねけん'));
        $this->assertSame('okayama', Converter::prefectureEnglishNameByHiraganaName('おかやまけん'));
        $this->assertSame('hiroshima', Converter::prefectureEnglishNameByHiraganaName('ひろしまけん'));
        $this->assertSame('yamaguchi', Converter::prefectureEnglishNameByHiraganaName('やまぐちけん'));
        $this->assertSame('tokushima', Converter::prefectureEnglishNameByHiraganaName('とくしまけん'));
        $this->assertSame('kagawa', Converter::prefectureEnglishNameByHiraganaName('かがわけん'));
        $this->assertSame('ehime', Converter::prefectureEnglishNameByHiraganaName('えひめけん'));
        $this->assertSame('kochi', Converter::prefectureEnglishNameByHiraganaName('こうちけん'));
        $this->assertSame('fukuoka', Converter::prefectureEnglishNameByHiraganaName('ふくおかけん'));
        $this->assertSame('saga', Converter::prefectureEnglishNameByHiraganaName('さがけん'));
        $this->assertSame('nagasaki', Converter::prefectureEnglishNameByHiraganaName('ながさきけん'));
        $this->assertSame('kumamoto', Converter::prefectureEnglishNameByHiraganaName('くまもとけん'));
        $this->assertSame('oita', Converter::prefectureEnglishNameByHiraganaName('おおいたけん'));
        $this->assertSame('miyazaki', Converter::prefectureEnglishNameByHiraganaName('みやざきけん'));
        $this->assertSame('kagoshima', Converter::prefectureEnglishNameByHiraganaName('かごしまけん'));
        $this->assertSame('okinawa', Converter::prefectureEnglishNameByHiraganaName('おきなわけん'));
        $this->assertNull(Converter::prefectureEnglishNameByHiraganaName('きょうてい'));
        $this->assertNull(Converter::prefectureEnglishNameByHiraganaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureEnglishNameByKatakanaName(): void
    {
        $this->assertSame('hokkaido', Converter::prefectureEnglishNameByKatakanaName('ホッカイドウ'));
        $this->assertSame('aomori', Converter::prefectureEnglishNameByKatakanaName('アオモリケン'));
        $this->assertSame('iwate', Converter::prefectureEnglishNameByKatakanaName('イワテケン'));
        $this->assertSame('miyagi', Converter::prefectureEnglishNameByKatakanaName('ミヤギケン'));
        $this->assertSame('akita', Converter::prefectureEnglishNameByKatakanaName('アキタケン'));
        $this->assertSame('yamagata', Converter::prefectureEnglishNameByKatakanaName('ヤマガタケン'));
        $this->assertSame('fukushima', Converter::prefectureEnglishNameByKatakanaName('フクシマケン'));
        $this->assertSame('ibaraki', Converter::prefectureEnglishNameByKatakanaName('イバラキケン'));
        $this->assertSame('tochigi', Converter::prefectureEnglishNameByKatakanaName('トチギケン'));
        $this->assertSame('gunma', Converter::prefectureEnglishNameByKatakanaName('グンマケン'));
        $this->assertSame('saitama', Converter::prefectureEnglishNameByKatakanaName('サイタマケン'));
        $this->assertSame('chiba', Converter::prefectureEnglishNameByKatakanaName('チバケン'));
        $this->assertSame('tokyo', Converter::prefectureEnglishNameByKatakanaName('トウキョウト'));
        $this->assertSame('kanagawa', Converter::prefectureEnglishNameByKatakanaName('カナガワケン'));
        $this->assertSame('niigata', Converter::prefectureEnglishNameByKatakanaName('ニイガタケン'));
        $this->assertSame('toyama', Converter::prefectureEnglishNameByKatakanaName('トヤマケン'));
        $this->assertSame('ishikawa', Converter::prefectureEnglishNameByKatakanaName('イシカワケン'));
        $this->assertSame('fukui', Converter::prefectureEnglishNameByKatakanaName('フクイケン'));
        $this->assertSame('yamanashi', Converter::prefectureEnglishNameByKatakanaName('ヤマナシケン'));
        $this->assertSame('nagano', Converter::prefectureEnglishNameByKatakanaName('ナガノケン'));
        $this->assertSame('gifu', Converter::prefectureEnglishNameByKatakanaName('ギフケン'));
        $this->assertSame('shizuoka', Converter::prefectureEnglishNameByKatakanaName('シズオカケン'));
        $this->assertSame('aichi', Converter::prefectureEnglishNameByKatakanaName('アイチケン'));
        $this->assertSame('mie', Converter::prefectureEnglishNameByKatakanaName('ミエケン'));
        $this->assertSame('shiga', Converter::prefectureEnglishNameByKatakanaName('シガケン'));
        $this->assertSame('kyoto', Converter::prefectureEnglishNameByKatakanaName('キョウトフ'));
        $this->assertSame('osaka', Converter::prefectureEnglishNameByKatakanaName('オオサカフ'));
        $this->assertSame('hyogo', Converter::prefectureEnglishNameByKatakanaName('ヒョウゴケン'));
        $this->assertSame('nara', Converter::prefectureEnglishNameByKatakanaName('ナラケン'));
        $this->assertSame('wakayama', Converter::prefectureEnglishNameByKatakanaName('ワカヤマケン'));
        $this->assertSame('tottori', Converter::prefectureEnglishNameByKatakanaName('トットリケン'));
        $this->assertSame('shimane', Converter::prefectureEnglishNameByKatakanaName('シマネケン'));
        $this->assertSame('okayama', Converter::prefectureEnglishNameByKatakanaName('オカヤマケン'));
        $this->assertSame('hiroshima', Converter::prefectureEnglishNameByKatakanaName('ヒロシマケン'));
        $this->assertSame('yamaguchi', Converter::prefectureEnglishNameByKatakanaName('ヤマグチケン'));
        $this->assertSame('tokushima', Converter::prefectureEnglishNameByKatakanaName('トクシマケン'));
        $this->assertSame('kagawa', Converter::prefectureEnglishNameByKatakanaName('カガワケン'));
        $this->assertSame('ehime', Converter::prefectureEnglishNameByKatakanaName('エヒメケン'));
        $this->assertSame('kochi', Converter::prefectureEnglishNameByKatakanaName('コウチケン'));
        $this->assertSame('fukuoka', Converter::prefectureEnglishNameByKatakanaName('フクオカケン'));
        $this->assertSame('saga', Converter::prefectureEnglishNameByKatakanaName('サガケン'));
        $this->assertSame('nagasaki', Converter::prefectureEnglishNameByKatakanaName('ナガサキケン'));
        $this->assertSame('kumamoto', Converter::prefectureEnglishNameByKatakanaName('クマモトケン'));
        $this->assertSame('oita', Converter::prefectureEnglishNameByKatakanaName('オオイタケン'));
        $this->assertSame('miyazaki', Converter::prefectureEnglishNameByKatakanaName('ミヤザキケン'));
        $this->assertSame('kagoshima', Converter::prefectureEnglishNameByKatakanaName('カゴシマケン'));
        $this->assertSame('okinawa', Converter::prefectureEnglishNameByKatakanaName('オキナワケン'));
        $this->assertNull(Converter::prefectureEnglishNameByKatakanaName('キョウテイ'));
        $this->assertNull(Converter::prefectureEnglishNameByKatakanaName(null));
    }

    /**
     * @return void
     */
    public function testStadiumIdByName(): void
    {
        $this->assertSame(1, Converter::stadiumIdByName('ボートレース桐生'));
        $this->assertSame(2, Converter::stadiumIdByName('ボートレース戸田'));
        $this->assertSame(3, Converter::stadiumIdByName('ボートレース江戸川'));
        $this->assertSame(4, Converter::stadiumIdByName('ボートレース平和島'));
        $this->assertSame(5, Converter::stadiumIdByName('ボートレース多摩川'));
        $this->assertSame(6, Converter::stadiumIdByName('ボートレース浜名湖'));
        $this->assertSame(7, Converter::stadiumIdByName('ボートレース蒲郡'));
        $this->assertSame(8, Converter::stadiumIdByName('ボートレース常滑'));
        $this->assertSame(9, Converter::stadiumIdByName('ボートレース津'));
        $this->assertSame(10, Converter::stadiumIdByName('ボートレース三国'));
        $this->assertSame(11, Converter::stadiumIdByName('ボートレースびわこ'));
        $this->assertSame(12, Converter::stadiumIdByName('ボートレース住之江'));
        $this->assertSame(13, Converter::stadiumIdByName('ボートレース尼崎'));
        $this->assertSame(14, Converter::stadiumIdByName('ボートレース鳴門'));
        $this->assertSame(15, Converter::stadiumIdByName('ボートレース丸亀'));
        $this->assertSame(16, Converter::stadiumIdByName('ボートレース児島'));
        $this->assertSame(17, Converter::stadiumIdByName('ボートレース宮島'));
        $this->assertSame(18, Converter::stadiumIdByName('ボートレース徳山'));
        $this->assertSame(19, Converter::stadiumIdByName('ボートレース下関'));
        $this->assertSame(20, Converter::stadiumIdByName('ボートレース若松'));
        $this->assertSame(21, Converter::stadiumIdByName('ボートレース芦屋'));
        $this->assertSame(22, Converter::stadiumIdByName('ボートレース福岡'));
        $this->assertSame(23, Converter::stadiumIdByName('ボートレース唐津'));
        $this->assertSame(24, Converter::stadiumIdByName('ボートレース大村'));
        $this->assertNull(Converter::stadiumIdByName('競艇'));
        $this->assertNull(Converter::stadiumIdByName(null));
    }

    /**
     * @return void
     */
    public function testStadiumIdByShortName(): void
    {
        $this->assertSame(1, Converter::stadiumIdByShortName('桐生'));
        $this->assertSame(2, Converter::stadiumIdByShortName('戸田'));
        $this->assertSame(3, Converter::stadiumIdByShortName('江戸川'));
        $this->assertSame(4, Converter::stadiumIdByShortName('平和島'));
        $this->assertSame(5, Converter::stadiumIdByShortName('多摩川'));
        $this->assertSame(6, Converter::stadiumIdByShortName('浜名湖'));
        $this->assertSame(7, Converter::stadiumIdByShortName('蒲郡'));
        $this->assertSame(8, Converter::stadiumIdByShortName('常滑'));
        $this->assertSame(9, Converter::stadiumIdByShortName('津'));
        $this->assertSame(10, Converter::stadiumIdByShortName('三国'));
        $this->assertSame(11, Converter::stadiumIdByShortName('びわこ'));
        $this->assertSame(12, Converter::stadiumIdByShortName('住之江'));
        $this->assertSame(13, Converter::stadiumIdByShortName('尼崎'));
        $this->assertSame(14, Converter::stadiumIdByShortName('鳴門'));
        $this->assertSame(15, Converter::stadiumIdByShortName('丸亀'));
        $this->assertSame(16, Converter::stadiumIdByShortName('児島'));
        $this->assertSame(17, Converter::stadiumIdByShortName('宮島'));
        $this->assertSame(18, Converter::stadiumIdByShortName('徳山'));
        $this->assertSame(19, Converter::stadiumIdByShortName('下関'));
        $this->assertSame(20, Converter::stadiumIdByShortName('若松'));
        $this->assertSame(21, Converter::stadiumIdByShortName('芦屋'));
        $this->assertSame(22, Converter::stadiumIdByShortName('福岡'));
        $this->assertSame(23, Converter::stadiumIdByShortName('唐津'));
        $this->assertSame(24, Converter::stadiumIdByShortName('大村'));
        $this->assertNull(Converter::stadiumIdByShortName('競艇'));
        $this->assertNull(Converter::stadiumIdByShortName(null));
    }

    /**
     * @return void
     */
    public function testStadiumNameById(): void
    {
        $this->assertSame('ボートレース桐生', Converter::stadiumNameById(1));
        $this->assertSame('ボートレース戸田', Converter::stadiumNameById(2));
        $this->assertSame('ボートレース江戸川', Converter::stadiumNameById(3));
        $this->assertSame('ボートレース平和島', Converter::stadiumNameById(4));
        $this->assertSame('ボートレース多摩川', Converter::stadiumNameById(5));
        $this->assertSame('ボートレース浜名湖', Converter::stadiumNameById(6));
        $this->assertSame('ボートレース蒲郡', Converter::stadiumNameById(7));
        $this->assertSame('ボートレース常滑', Converter::stadiumNameById(8));
        $this->assertSame('ボートレース津', Converter::stadiumNameById(9));
        $this->assertSame('ボートレース三国', Converter::stadiumNameById(10));
        $this->assertSame('ボートレースびわこ', Converter::stadiumNameById(11));
        $this->assertSame('ボートレース住之江', Converter::stadiumNameById(12));
        $this->assertSame('ボートレース尼崎', Converter::stadiumNameById(13));
        $this->assertSame('ボートレース鳴門', Converter::stadiumNameById(14));
        $this->assertSame('ボートレース丸亀', Converter::stadiumNameById(15));
        $this->assertSame('ボートレース児島', Converter::stadiumNameById(16));
        $this->assertSame('ボートレース宮島', Converter::stadiumNameById(17));
        $this->assertSame('ボートレース徳山', Converter::stadiumNameById(18));
        $this->assertSame('ボートレース下関', Converter::stadiumNameById(19));
        $this->assertSame('ボートレース若松', Converter::stadiumNameById(20));
        $this->assertSame('ボートレース芦屋', Converter::stadiumNameById(21));
        $this->assertSame('ボートレース福岡', Converter::stadiumNameById(22));
        $this->assertSame('ボートレース唐津', Converter::stadiumNameById(23));
        $this->assertSame('ボートレース大村', Converter::stadiumNameById(24));
        $this->assertNull(Converter::stadiumNameById(25));
        $this->assertNull(Converter::stadiumNameById(null));
    }

    /**
     * @return void
     */
    public function testStadiumNameByShortName(): void
    {
        $this->assertSame('ボートレース桐生', Converter::stadiumNameByShortName('桐生'));
        $this->assertSame('ボートレース戸田', Converter::stadiumNameByShortName('戸田'));
        $this->assertSame('ボートレース江戸川', Converter::stadiumNameByShortName('江戸川'));
        $this->assertSame('ボートレース平和島', Converter::stadiumNameByShortName('平和島'));
        $this->assertSame('ボートレース多摩川', Converter::stadiumNameByShortName('多摩川'));
        $this->assertSame('ボートレース浜名湖', Converter::stadiumNameByShortName('浜名湖'));
        $this->assertSame('ボートレース蒲郡', Converter::stadiumNameByShortName('蒲郡'));
        $this->assertSame('ボートレース常滑', Converter::stadiumNameByShortName('常滑'));
        $this->assertSame('ボートレース津', Converter::stadiumNameByShortName('津'));
        $this->assertSame('ボートレース三国', Converter::stadiumNameByShortName('三国'));
        $this->assertSame('ボートレースびわこ', Converter::stadiumNameByShortName('びわこ'));
        $this->assertSame('ボートレース住之江', Converter::stadiumNameByShortName('住之江'));
        $this->assertSame('ボートレース尼崎', Converter::stadiumNameByShortName('尼崎'));
        $this->assertSame('ボートレース鳴門', Converter::stadiumNameByShortName('鳴門'));
        $this->assertSame('ボートレース丸亀', Converter::stadiumNameByShortName('丸亀'));
        $this->assertSame('ボートレース児島', Converter::stadiumNameByShortName('児島'));
        $this->assertSame('ボートレース宮島', Converter::stadiumNameByShortName('宮島'));
        $this->assertSame('ボートレース徳山', Converter::stadiumNameByShortName('徳山'));
        $this->assertSame('ボートレース下関', Converter::stadiumNameByShortName('下関'));
        $this->assertSame('ボートレース若松', Converter::stadiumNameByShortName('若松'));
        $this->assertSame('ボートレース芦屋', Converter::stadiumNameByShortName('芦屋'));
        $this->assertSame('ボートレース福岡', Converter::stadiumNameByShortName('福岡'));
        $this->assertSame('ボートレース唐津', Converter::stadiumNameByShortName('唐津'));
        $this->assertSame('ボートレース大村', Converter::stadiumNameByShortName('大村'));
        $this->assertNull(Converter::stadiumNameByShortName('競艇'));
        $this->assertNull(Converter::stadiumNameByShortName(null));
    }

    /**
     * @return void
     */
    public function testStadiumShortNameById(): void
    {
        $this->assertSame('桐生', Converter::stadiumShortNameById(1));
        $this->assertSame('戸田', Converter::stadiumShortNameById(2));
        $this->assertSame('江戸川', Converter::stadiumShortNameById(3));
        $this->assertSame('平和島', Converter::stadiumShortNameById(4));
        $this->assertSame('多摩川', Converter::stadiumShortNameById(5));
        $this->assertSame('浜名湖', Converter::stadiumShortNameById(6));
        $this->assertSame('蒲郡', Converter::stadiumShortNameById(7));
        $this->assertSame('常滑', Converter::stadiumShortNameById(8));
        $this->assertSame('津', Converter::stadiumShortNameById(9));
        $this->assertSame('三国', Converter::stadiumShortNameById(10));
        $this->assertSame('びわこ', Converter::stadiumShortNameById(11));
        $this->assertSame('住之江', Converter::stadiumShortNameById(12));
        $this->assertSame('尼崎', Converter::stadiumShortNameById(13));
        $this->assertSame('鳴門', Converter::stadiumShortNameById(14));
        $this->assertSame('丸亀', Converter::stadiumShortNameById(15));
        $this->assertSame('児島', Converter::stadiumShortNameById(16));
        $this->assertSame('宮島', Converter::stadiumShortNameById(17));
        $this->assertSame('徳山', Converter::stadiumShortNameById(18));
        $this->assertSame('下関', Converter::stadiumShortNameById(19));
        $this->assertSame('若松', Converter::stadiumShortNameById(20));
        $this->assertSame('芦屋', Converter::stadiumShortNameById(21));
        $this->assertSame('福岡', Converter::stadiumShortNameById(22));
        $this->assertSame('唐津', Converter::stadiumShortNameById(23));
        $this->assertSame('大村', Converter::stadiumShortNameById(24));
        $this->assertNull(Converter::stadiumShortNameById(25));
        $this->assertNull(Converter::stadiumShortNameById(null));
    }

    /**
     * @return void
     */
    public function testStadiumShortNameByName(): void
    {
        $this->assertSame('桐生', Converter::stadiumShortNameByName('ボートレース桐生'));
        $this->assertSame('戸田', Converter::stadiumShortNameByName('ボートレース戸田'));
        $this->assertSame('江戸川', Converter::stadiumShortNameByName('ボートレース江戸川'));
        $this->assertSame('平和島', Converter::stadiumShortNameByName('ボートレース平和島'));
        $this->assertSame('多摩川', Converter::stadiumShortNameByName('ボートレース多摩川'));
        $this->assertSame('浜名湖', Converter::stadiumShortNameByName('ボートレース浜名湖'));
        $this->assertSame('蒲郡', Converter::stadiumShortNameByName('ボートレース蒲郡'));
        $this->assertSame('常滑', Converter::stadiumShortNameByName('ボートレース常滑'));
        $this->assertSame('津', Converter::stadiumShortNameByName('ボートレース津'));
        $this->assertSame('三国', Converter::stadiumShortNameByName('ボートレース三国'));
        $this->assertSame('びわこ', Converter::stadiumShortNameByName('ボートレースびわこ'));
        $this->assertSame('住之江', Converter::stadiumShortNameByName('ボートレース住之江'));
        $this->assertSame('尼崎', Converter::stadiumShortNameByName('ボートレース尼崎'));
        $this->assertSame('鳴門', Converter::stadiumShortNameByName('ボートレース鳴門'));
        $this->assertSame('丸亀', Converter::stadiumShortNameByName('ボートレース丸亀'));
        $this->assertSame('児島', Converter::stadiumShortNameByName('ボートレース児島'));
        $this->assertSame('宮島', Converter::stadiumShortNameByName('ボートレース宮島'));
        $this->assertSame('徳山', Converter::stadiumShortNameByName('ボートレース徳山'));
        $this->assertSame('下関', Converter::stadiumShortNameByName('ボートレース下関'));
        $this->assertSame('若松', Converter::stadiumShortNameByName('ボートレース若松'));
        $this->assertSame('芦屋', Converter::stadiumShortNameByName('ボートレース芦屋'));
        $this->assertSame('福岡', Converter::stadiumShortNameByName('ボートレース福岡'));
        $this->assertSame('唐津', Converter::stadiumShortNameByName('ボートレース唐津'));
        $this->assertSame('大村', Converter::stadiumShortNameByName('ボートレース大村'));
        $this->assertNull(Converter::stadiumShortNameByName('競艇'));
        $this->assertNull(Converter::stadiumShortNameByName(null));
    }
}
