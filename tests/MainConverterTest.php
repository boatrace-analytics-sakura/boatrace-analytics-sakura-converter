<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project\Tests;

use Boatrace\Venture\Project\MainConverter;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * @author shimomo
 */
class MainConverterTest extends PHPUnitTestCase
{
    /**
     * @var \Boatrace\Venture\Project\MainConverter
     */
    protected MainConverter $converter;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->converter = new MainConverter;
    }

    /**
     * @return void
     */
    public function testString(): void
    {
        $this->assertSame('', $this->converter->string(' '));
        $this->assertSame('', $this->converter->string('　'));
        $this->assertSame('1', $this->converter->string('1'));
        $this->assertSame('1', $this->converter->string('１'));
        $this->assertNull($this->converter->string(null));
    }

    /**
     * @return void
     */
    public function testInt(): void
    {
        $this->assertSame(1, $this->converter->int('1'));
        $this->assertSame(1, $this->converter->int('１'));
        $this->assertNull($this->converter->int(null));
    }

    /**
     * @return void
     */
    public function testFloat(): void
    {
        $this->assertSame(1.0, $this->converter->float('1.0'));
        $this->assertSame(1.0, $this->converter->float('１.０'));
        $this->assertNull($this->converter->float(null));
    }

    /**
     * @return void
     */
    public function testName(): void
    {
        $this->assertSame('中辻 博訓', $this->converter->name('中辻 博訓'));
        $this->assertSame('中辻 博訓', $this->converter->name('中辻　博訓'));
        $this->assertNull($this->converter->name(null));
    }

    /**
     * @return void
     */
    public function testFlying(): void
    {
        $this->assertSame(1, $this->converter->flying('F1'));
        $this->assertSame(1, $this->converter->flying('F１'));
        $this->assertNull($this->converter->flying(null));
    }

    /**
     * @return void
     */
    public function testLate(): void
    {
        $this->assertSame(1, $this->converter->late('L1'));
        $this->assertSame(1, $this->converter->late('L１'));
        $this->assertNull($this->converter->late(null));
    }

    /**
     * @return void
     */
    public function testStartTiming(): void
    {
        $this->assertSame(0.10, $this->converter->startTiming('.10'));
        $this->assertSame(0.10, $this->converter->startTiming('.１０'));
        $this->assertSame(1.0, $this->converter->startTiming('L'));
        $this->assertSame(-1.0, $this->converter->startTiming('F'));
        $this->assertNull($this->converter->startTiming(null));
    }

    /**
     * @return void
     */
    public function testWind(): void
    {
        $this->assertSame(1, $this->converter->wind('1m'));
        $this->assertSame(1, $this->converter->wind('１m'));
        $this->assertNull($this->converter->wind(null));
    }

    /**
     * @return void
     */
    public function testWave(): void
    {
        $this->assertSame(1, $this->converter->wave('1cm'));
        $this->assertSame(1, $this->converter->wave('１cm'));
        $this->assertNull($this->converter->wave(null));
    }

    /**
     * @return void
     */
    public function testTemperature(): void
    {
        $this->assertSame(1.0, $this->converter->temperature('1.0℃'));
        $this->assertSame(1.0, $this->converter->temperature('１.０℃'));
        $this->assertNull($this->converter->temperature(null));
    }

    /**
     * @return void
     */
    public function testDirection(): void
    {
        $this->assertSame(11, $this->converter->direction('weather1_bodyUnitImage is-wind11'));
        $this->assertNull($this->converter->direction(null));
    }

    /**
     * @return void
     */
    public function testDate(): void
    {
        $this->assertSame('2019-07-01', $this->converter->date('20190701'));
        $this->assertNull($this->converter->date(null));
    }

    /**
     * @return void
     */
    public function testDateTime(): void
    {
        $this->assertSame('2019-07-01 12:30:00', $this->converter->dateTime('20190701 123000'));
        $this->assertNull($this->converter->dateTime(null));
    }

    /**
     * @return void
     */
    public function testClassIdByShortName(): void
    {
        $this->assertSame(1, $this->converter->classIdByShortName('A1'));
        $this->assertSame(1, $this->converter->classIdByShortName('A１'));
        $this->assertSame(2, $this->converter->classIdByShortName('A2'));
        $this->assertSame(2, $this->converter->classIdByShortName('A２'));
        $this->assertSame(3, $this->converter->classIdByShortName('B1'));
        $this->assertSame(3, $this->converter->classIdByShortName('B１'));
        $this->assertSame(4, $this->converter->classIdByShortName('B2'));
        $this->assertSame(4, $this->converter->classIdByShortName('B２'));
        $this->assertNull($this->converter->classIdByShortName('競艇'));
        $this->assertNull($this->converter->classIdByShortName(null));
    }

    /**
     * @return void
     */
    public function testClassShortNameById(): void
    {
        $this->assertSame('A1', $this->converter->classShortNameById(1));
        $this->assertSame('A2', $this->converter->classShortNameById(2));
        $this->assertSame('B1', $this->converter->classShortNameById(3));
        $this->assertSame('B2', $this->converter->classShortNameById(4));
        $this->assertNull($this->converter->classShortNameById(5));
        $this->assertNull($this->converter->classShortNameById(null));
    }

    /**
     * @return void
     */
    public function testPlaceIdByShortName(): void
    {
        $this->assertSame(1, $this->converter->placeIdByShortName('1'));
        $this->assertSame(1, $this->converter->placeIdByShortName('１'));
        $this->assertSame(2, $this->converter->placeIdByShortName('2'));
        $this->assertSame(2, $this->converter->placeIdByShortName('２'));
        $this->assertSame(3, $this->converter->placeIdByShortName('3'));
        $this->assertSame(3, $this->converter->placeIdByShortName('３'));
        $this->assertSame(4, $this->converter->placeIdByShortName('4'));
        $this->assertSame(4, $this->converter->placeIdByShortName('４'));
        $this->assertSame(5, $this->converter->placeIdByShortName('5'));
        $this->assertSame(5, $this->converter->placeIdByShortName('５'));
        $this->assertSame(6, $this->converter->placeIdByShortName('6'));
        $this->assertSame(6, $this->converter->placeIdByShortName('６'));
        $this->assertSame(7, $this->converter->placeIdByShortName('妨'));
        $this->assertSame(8, $this->converter->placeIdByShortName('エ'));
        $this->assertSame(9, $this->converter->placeIdByShortName('転'));
        $this->assertSame(10, $this->converter->placeIdByShortName('落'));
        $this->assertSame(11, $this->converter->placeIdByShortName('沈'));
        $this->assertSame(12, $this->converter->placeIdByShortName('不'));
        $this->assertSame(13, $this->converter->placeIdByShortName('失'));
        $this->assertSame(14, $this->converter->placeIdByShortName('F'));
        $this->assertSame(15, $this->converter->placeIdByShortName('L'));
        $this->assertSame(16, $this->converter->placeIdByShortName('欠'));
        $this->assertNull($this->converter->placeIdByShortName('競艇'));
        $this->assertNull($this->converter->placeIdByShortName(null));
    }

    /**
     * @return void
     */
    public function testPlaceShortNameById(): void
    {
        $this->assertSame('1', $this->converter->placeShortNameById(1));
        $this->assertSame('2', $this->converter->placeShortNameById(2));
        $this->assertSame('3', $this->converter->placeShortNameById(3));
        $this->assertSame('4', $this->converter->placeShortNameById(4));
        $this->assertSame('5', $this->converter->placeShortNameById(5));
        $this->assertSame('6', $this->converter->placeShortNameById(6));
        $this->assertSame('妨', $this->converter->placeShortNameById(7));
        $this->assertSame('エ', $this->converter->placeShortNameById(8));
        $this->assertSame('転', $this->converter->placeShortNameById(9));
        $this->assertSame('落', $this->converter->placeShortNameById(10));
        $this->assertSame('沈', $this->converter->placeShortNameById(11));
        $this->assertSame('不', $this->converter->placeShortNameById(12));
        $this->assertSame('失', $this->converter->placeShortNameById(13));
        $this->assertSame('F', $this->converter->placeShortNameById(14));
        $this->assertSame('L', $this->converter->placeShortNameById(15));
        $this->assertSame('欠', $this->converter->placeShortNameById(16));
        $this->assertNull($this->converter->placeShortNameById(17));
        $this->assertNull($this->converter->placeShortNameById(null));
    }

    /**
     * @return void
     */
    public function testTechniqueIdByName(): void
    {
        $this->assertSame(1, $this->converter->techniqueIdByName('逃げ'));
        $this->assertSame(2, $this->converter->techniqueIdByName('差し'));
        $this->assertSame(3, $this->converter->techniqueIdByName('まくり'));
        $this->assertSame(4, $this->converter->techniqueIdByName('まくり差し'));
        $this->assertSame(5, $this->converter->techniqueIdByName('抜き'));
        $this->assertSame(6, $this->converter->techniqueIdByName('恵まれ'));
        $this->assertNull($this->converter->techniqueIdByName('競艇'));
        $this->assertNull($this->converter->techniqueIdByName(null));
    }

    /**
     * @return void
     */
    public function testTechniqueNameById(): void
    {
        $this->assertSame('逃げ', $this->converter->techniqueNameById(1));
        $this->assertSame('差し', $this->converter->techniqueNameById(2));
        $this->assertSame('まくり', $this->converter->techniqueNameById(3));
        $this->assertSame('まくり差し', $this->converter->techniqueNameById(4));
        $this->assertSame('抜き', $this->converter->techniqueNameById(5));
        $this->assertSame('恵まれ', $this->converter->techniqueNameById(6));
        $this->assertNull($this->converter->techniqueNameById(7));
        $this->assertNull($this->converter->techniqueNameById(null));
    }

    /**
     * @return void
     */
    public function testWeatherIdByName(): void
    {
        $this->assertSame(1, $this->converter->weatherIdByName('晴'));
        $this->assertSame(2, $this->converter->weatherIdByName('曇り'));
        $this->assertSame(3, $this->converter->weatherIdByName('雨'));
        $this->assertSame(4, $this->converter->weatherIdByName('雪'));
        $this->assertSame(5, $this->converter->weatherIdByName('霧'));
        $this->assertNull($this->converter->weatherIdByName('競艇'));
        $this->assertNull($this->converter->weatherIdByName(null));
    }

    /**
     * @return void
     */
    public function testWeatherNameById(): void
    {
        $this->assertSame('晴', $this->converter->weatherNameById(1));
        $this->assertSame('曇り', $this->converter->weatherNameById(2));
        $this->assertSame('雨', $this->converter->weatherNameById(3));
        $this->assertSame('雪', $this->converter->weatherNameById(4));
        $this->assertSame('霧', $this->converter->weatherNameById(5));
        $this->assertNull($this->converter->weatherNameById(6));
        $this->assertNull($this->converter->weatherNameById(null));
    }

    /**
     * @return void
     */
    public function testDirectionShortNameById(): void
    {
        $this->assertSame('↑', $this->converter->directionShortNameById(1));
        $this->assertSame('↑', $this->converter->directionShortNameById(2));
        $this->assertSame('↗', $this->converter->directionShortNameById(3));
        $this->assertSame('→', $this->converter->directionShortNameById(4));
        $this->assertSame('→', $this->converter->directionShortNameById(5));
        $this->assertSame('→', $this->converter->directionShortNameById(6));
        $this->assertSame('↘', $this->converter->directionShortNameById(7));
        $this->assertSame('↓', $this->converter->directionShortNameById(8));
        $this->assertSame('↓', $this->converter->directionShortNameById(9));
        $this->assertSame('↓', $this->converter->directionShortNameById(10));
        $this->assertSame('↙', $this->converter->directionShortNameById(11));
        $this->assertSame('←', $this->converter->directionShortNameById(12));
        $this->assertSame('←', $this->converter->directionShortNameById(13));
        $this->assertSame('←', $this->converter->directionShortNameById(14));
        $this->assertSame('↖', $this->converter->directionShortNameById(15));
        $this->assertSame('↑', $this->converter->directionShortNameById(16));
        $this->assertSame('', $this->converter->directionShortNameById(17));
        $this->assertNull($this->converter->directionShortNameById(18));
        $this->assertNull($this->converter->directionShortNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureIdByName(): void
    {
        $this->assertSame(1, $this->converter->prefectureIdByName('北海道'));
        $this->assertSame(2, $this->converter->prefectureIdByName('青森県'));
        $this->assertSame(3, $this->converter->prefectureIdByName('岩手県'));
        $this->assertSame(4, $this->converter->prefectureIdByName('宮城県'));
        $this->assertSame(5, $this->converter->prefectureIdByName('秋田県'));
        $this->assertSame(6, $this->converter->prefectureIdByName('山形県'));
        $this->assertSame(7, $this->converter->prefectureIdByName('福島県'));
        $this->assertSame(8, $this->converter->prefectureIdByName('茨城県'));
        $this->assertSame(9, $this->converter->prefectureIdByName('栃木県'));
        $this->assertSame(10, $this->converter->prefectureIdByName('群馬県'));
        $this->assertSame(11, $this->converter->prefectureIdByName('埼玉県'));
        $this->assertSame(12, $this->converter->prefectureIdByName('千葉県'));
        $this->assertSame(13, $this->converter->prefectureIdByName('東京都'));
        $this->assertSame(14, $this->converter->prefectureIdByName('神奈川県'));
        $this->assertSame(15, $this->converter->prefectureIdByName('新潟県'));
        $this->assertSame(16, $this->converter->prefectureIdByName('富山県'));
        $this->assertSame(17, $this->converter->prefectureIdByName('石川県'));
        $this->assertSame(18, $this->converter->prefectureIdByName('福井県'));
        $this->assertSame(19, $this->converter->prefectureIdByName('山梨県'));
        $this->assertSame(20, $this->converter->prefectureIdByName('長野県'));
        $this->assertSame(21, $this->converter->prefectureIdByName('岐阜県'));
        $this->assertSame(22, $this->converter->prefectureIdByName('静岡県'));
        $this->assertSame(23, $this->converter->prefectureIdByName('愛知県'));
        $this->assertSame(24, $this->converter->prefectureIdByName('三重県'));
        $this->assertSame(25, $this->converter->prefectureIdByName('滋賀県'));
        $this->assertSame(26, $this->converter->prefectureIdByName('京都府'));
        $this->assertSame(27, $this->converter->prefectureIdByName('大阪府'));
        $this->assertSame(28, $this->converter->prefectureIdByName('兵庫県'));
        $this->assertSame(29, $this->converter->prefectureIdByName('奈良県'));
        $this->assertSame(30, $this->converter->prefectureIdByName('和歌山県'));
        $this->assertSame(31, $this->converter->prefectureIdByName('鳥取県'));
        $this->assertSame(32, $this->converter->prefectureIdByName('島根県'));
        $this->assertSame(33, $this->converter->prefectureIdByName('岡山県'));
        $this->assertSame(34, $this->converter->prefectureIdByName('広島県'));
        $this->assertSame(35, $this->converter->prefectureIdByName('山口県'));
        $this->assertSame(36, $this->converter->prefectureIdByName('徳島県'));
        $this->assertSame(37, $this->converter->prefectureIdByName('香川県'));
        $this->assertSame(38, $this->converter->prefectureIdByName('愛媛県'));
        $this->assertSame(39, $this->converter->prefectureIdByName('高知県'));
        $this->assertSame(40, $this->converter->prefectureIdByName('福岡県'));
        $this->assertSame(41, $this->converter->prefectureIdByName('佐賀県'));
        $this->assertSame(42, $this->converter->prefectureIdByName('長崎県'));
        $this->assertSame(43, $this->converter->prefectureIdByName('熊本県'));
        $this->assertSame(44, $this->converter->prefectureIdByName('大分県'));
        $this->assertSame(45, $this->converter->prefectureIdByName('宮崎県'));
        $this->assertSame(46, $this->converter->prefectureIdByName('鹿児島県'));
        $this->assertSame(47, $this->converter->prefectureIdByName('沖縄県'));
        $this->assertNull($this->converter->prefectureIdByName('競艇'));
        $this->assertNull($this->converter->prefectureIdByName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureIdByShortName(): void
    {
        $this->assertSame(1, $this->converter->prefectureIdByShortName('北海道'));
        $this->assertSame(2, $this->converter->prefectureIdByShortName('青森'));
        $this->assertSame(3, $this->converter->prefectureIdByShortName('岩手'));
        $this->assertSame(4, $this->converter->prefectureIdByShortName('宮城'));
        $this->assertSame(5, $this->converter->prefectureIdByShortName('秋田'));
        $this->assertSame(6, $this->converter->prefectureIdByShortName('山形'));
        $this->assertSame(7, $this->converter->prefectureIdByShortName('福島'));
        $this->assertSame(8, $this->converter->prefectureIdByShortName('茨城'));
        $this->assertSame(9, $this->converter->prefectureIdByShortName('栃木'));
        $this->assertSame(10, $this->converter->prefectureIdByShortName('群馬'));
        $this->assertSame(11, $this->converter->prefectureIdByShortName('埼玉'));
        $this->assertSame(12, $this->converter->prefectureIdByShortName('千葉'));
        $this->assertSame(13, $this->converter->prefectureIdByShortName('東京'));
        $this->assertSame(14, $this->converter->prefectureIdByShortName('神奈川'));
        $this->assertSame(15, $this->converter->prefectureIdByShortName('新潟'));
        $this->assertSame(16, $this->converter->prefectureIdByShortName('富山'));
        $this->assertSame(17, $this->converter->prefectureIdByShortName('石川'));
        $this->assertSame(18, $this->converter->prefectureIdByShortName('福井'));
        $this->assertSame(19, $this->converter->prefectureIdByShortName('山梨'));
        $this->assertSame(20, $this->converter->prefectureIdByShortName('長野'));
        $this->assertSame(21, $this->converter->prefectureIdByShortName('岐阜'));
        $this->assertSame(22, $this->converter->prefectureIdByShortName('静岡'));
        $this->assertSame(23, $this->converter->prefectureIdByShortName('愛知'));
        $this->assertSame(24, $this->converter->prefectureIdByShortName('三重'));
        $this->assertSame(25, $this->converter->prefectureIdByShortName('滋賀'));
        $this->assertSame(26, $this->converter->prefectureIdByShortName('京都'));
        $this->assertSame(27, $this->converter->prefectureIdByShortName('大阪'));
        $this->assertSame(28, $this->converter->prefectureIdByShortName('兵庫'));
        $this->assertSame(29, $this->converter->prefectureIdByShortName('奈良'));
        $this->assertSame(30, $this->converter->prefectureIdByShortName('和歌山'));
        $this->assertSame(31, $this->converter->prefectureIdByShortName('鳥取'));
        $this->assertSame(32, $this->converter->prefectureIdByShortName('島根'));
        $this->assertSame(33, $this->converter->prefectureIdByShortName('岡山'));
        $this->assertSame(34, $this->converter->prefectureIdByShortName('広島'));
        $this->assertSame(35, $this->converter->prefectureIdByShortName('山口'));
        $this->assertSame(36, $this->converter->prefectureIdByShortName('徳島'));
        $this->assertSame(37, $this->converter->prefectureIdByShortName('香川'));
        $this->assertSame(38, $this->converter->prefectureIdByShortName('愛媛'));
        $this->assertSame(39, $this->converter->prefectureIdByShortName('高知'));
        $this->assertSame(40, $this->converter->prefectureIdByShortName('福岡'));
        $this->assertSame(41, $this->converter->prefectureIdByShortName('佐賀'));
        $this->assertSame(42, $this->converter->prefectureIdByShortName('長崎'));
        $this->assertSame(43, $this->converter->prefectureIdByShortName('熊本'));
        $this->assertSame(44, $this->converter->prefectureIdByShortName('大分'));
        $this->assertSame(45, $this->converter->prefectureIdByShortName('宮崎'));
        $this->assertSame(46, $this->converter->prefectureIdByShortName('鹿児島'));
        $this->assertSame(47, $this->converter->prefectureIdByShortName('沖縄'));
        $this->assertNull($this->converter->prefectureIdByShortName('競艇'));
        $this->assertNull($this->converter->prefectureIdByShortName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureIdByHiraganaName(): void
    {
        $this->assertSame(1, $this->converter->prefectureIdByHiraganaName('ほっかいどう'));
        $this->assertSame(2, $this->converter->prefectureIdByHiraganaName('あおもりけん'));
        $this->assertSame(3, $this->converter->prefectureIdByHiraganaName('いわてけん'));
        $this->assertSame(4, $this->converter->prefectureIdByHiraganaName('みやぎけん'));
        $this->assertSame(5, $this->converter->prefectureIdByHiraganaName('あきたけん'));
        $this->assertSame(6, $this->converter->prefectureIdByHiraganaName('やまがたけん'));
        $this->assertSame(7, $this->converter->prefectureIdByHiraganaName('ふくしまけん'));
        $this->assertSame(8, $this->converter->prefectureIdByHiraganaName('いばらきけん'));
        $this->assertSame(9, $this->converter->prefectureIdByHiraganaName('とちぎけん'));
        $this->assertSame(10, $this->converter->prefectureIdByHiraganaName('ぐんまけん'));
        $this->assertSame(11, $this->converter->prefectureIdByHiraganaName('さいたまけん'));
        $this->assertSame(12, $this->converter->prefectureIdByHiraganaName('ちばけん'));
        $this->assertSame(13, $this->converter->prefectureIdByHiraganaName('とうきょうと'));
        $this->assertSame(14, $this->converter->prefectureIdByHiraganaName('かながわけん'));
        $this->assertSame(15, $this->converter->prefectureIdByHiraganaName('にいがたけん'));
        $this->assertSame(16, $this->converter->prefectureIdByHiraganaName('とやまけん'));
        $this->assertSame(17, $this->converter->prefectureIdByHiraganaName('いしかわけん'));
        $this->assertSame(18, $this->converter->prefectureIdByHiraganaName('ふくいけん'));
        $this->assertSame(19, $this->converter->prefectureIdByHiraganaName('やまなしけん'));
        $this->assertSame(20, $this->converter->prefectureIdByHiraganaName('ながのけん'));
        $this->assertSame(21, $this->converter->prefectureIdByHiraganaName('ぎふけん'));
        $this->assertSame(22, $this->converter->prefectureIdByHiraganaName('しずおかけん'));
        $this->assertSame(23, $this->converter->prefectureIdByHiraganaName('あいちけん'));
        $this->assertSame(24, $this->converter->prefectureIdByHiraganaName('みえけん'));
        $this->assertSame(25, $this->converter->prefectureIdByHiraganaName('しがけん'));
        $this->assertSame(26, $this->converter->prefectureIdByHiraganaName('きょうとふ'));
        $this->assertSame(27, $this->converter->prefectureIdByHiraganaName('おおさかふ'));
        $this->assertSame(28, $this->converter->prefectureIdByHiraganaName('ひょうごけん'));
        $this->assertSame(29, $this->converter->prefectureIdByHiraganaName('ならけん'));
        $this->assertSame(30, $this->converter->prefectureIdByHiraganaName('わかやまけん'));
        $this->assertSame(31, $this->converter->prefectureIdByHiraganaName('とっとりけん'));
        $this->assertSame(32, $this->converter->prefectureIdByHiraganaName('しまねけん'));
        $this->assertSame(33, $this->converter->prefectureIdByHiraganaName('おかやまけん'));
        $this->assertSame(34, $this->converter->prefectureIdByHiraganaName('ひろしまけん'));
        $this->assertSame(35, $this->converter->prefectureIdByHiraganaName('やまぐちけん'));
        $this->assertSame(36, $this->converter->prefectureIdByHiraganaName('とくしまけん'));
        $this->assertSame(37, $this->converter->prefectureIdByHiraganaName('かがわけん'));
        $this->assertSame(38, $this->converter->prefectureIdByHiraganaName('えひめけん'));
        $this->assertSame(39, $this->converter->prefectureIdByHiraganaName('こうちけん'));
        $this->assertSame(40, $this->converter->prefectureIdByHiraganaName('ふくおかけん'));
        $this->assertSame(41, $this->converter->prefectureIdByHiraganaName('さがけん'));
        $this->assertSame(42, $this->converter->prefectureIdByHiraganaName('ながさきけん'));
        $this->assertSame(43, $this->converter->prefectureIdByHiraganaName('くまもとけん'));
        $this->assertSame(44, $this->converter->prefectureIdByHiraganaName('おおいたけん'));
        $this->assertSame(45, $this->converter->prefectureIdByHiraganaName('みやざきけん'));
        $this->assertSame(46, $this->converter->prefectureIdByHiraganaName('かごしまけん'));
        $this->assertSame(47, $this->converter->prefectureIdByHiraganaName('おきなわけん'));
        $this->assertNull($this->converter->prefectureIdByHiraganaName('きょうてい'));
        $this->assertNull($this->converter->prefectureIdByHiraganaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureIdByKatakanaName(): void
    {
        $this->assertSame(1, $this->converter->prefectureIdByKatakanaName('ホッカイドウ'));
        $this->assertSame(2, $this->converter->prefectureIdByKatakanaName('アオモリケン'));
        $this->assertSame(3, $this->converter->prefectureIdByKatakanaName('イワテケン'));
        $this->assertSame(4, $this->converter->prefectureIdByKatakanaName('ミヤギケン'));
        $this->assertSame(5, $this->converter->prefectureIdByKatakanaName('アキタケン'));
        $this->assertSame(6, $this->converter->prefectureIdByKatakanaName('ヤマガタケン'));
        $this->assertSame(7, $this->converter->prefectureIdByKatakanaName('フクシマケン'));
        $this->assertSame(8, $this->converter->prefectureIdByKatakanaName('イバラキケン'));
        $this->assertSame(9, $this->converter->prefectureIdByKatakanaName('トチギケン'));
        $this->assertSame(10, $this->converter->prefectureIdByKatakanaName('グンマケン'));
        $this->assertSame(11, $this->converter->prefectureIdByKatakanaName('サイタマケン'));
        $this->assertSame(12, $this->converter->prefectureIdByKatakanaName('チバケン'));
        $this->assertSame(13, $this->converter->prefectureIdByKatakanaName('トウキョウト'));
        $this->assertSame(14, $this->converter->prefectureIdByKatakanaName('カナガワケン'));
        $this->assertSame(15, $this->converter->prefectureIdByKatakanaName('ニイガタケン'));
        $this->assertSame(16, $this->converter->prefectureIdByKatakanaName('トヤマケン'));
        $this->assertSame(17, $this->converter->prefectureIdByKatakanaName('イシカワケン'));
        $this->assertSame(18, $this->converter->prefectureIdByKatakanaName('フクイケン'));
        $this->assertSame(19, $this->converter->prefectureIdByKatakanaName('ヤマナシケン'));
        $this->assertSame(20, $this->converter->prefectureIdByKatakanaName('ナガノケン'));
        $this->assertSame(21, $this->converter->prefectureIdByKatakanaName('ギフケン'));
        $this->assertSame(22, $this->converter->prefectureIdByKatakanaName('シズオカケン'));
        $this->assertSame(23, $this->converter->prefectureIdByKatakanaName('アイチケン'));
        $this->assertSame(24, $this->converter->prefectureIdByKatakanaName('ミエケン'));
        $this->assertSame(25, $this->converter->prefectureIdByKatakanaName('シガケン'));
        $this->assertSame(26, $this->converter->prefectureIdByKatakanaName('キョウトフ'));
        $this->assertSame(27, $this->converter->prefectureIdByKatakanaName('オオサカフ'));
        $this->assertSame(28, $this->converter->prefectureIdByKatakanaName('ヒョウゴケン'));
        $this->assertSame(29, $this->converter->prefectureIdByKatakanaName('ナラケン'));
        $this->assertSame(30, $this->converter->prefectureIdByKatakanaName('ワカヤマケン'));
        $this->assertSame(31, $this->converter->prefectureIdByKatakanaName('トットリケン'));
        $this->assertSame(32, $this->converter->prefectureIdByKatakanaName('シマネケン'));
        $this->assertSame(33, $this->converter->prefectureIdByKatakanaName('オカヤマケン'));
        $this->assertSame(34, $this->converter->prefectureIdByKatakanaName('ヒロシマケン'));
        $this->assertSame(35, $this->converter->prefectureIdByKatakanaName('ヤマグチケン'));
        $this->assertSame(36, $this->converter->prefectureIdByKatakanaName('トクシマケン'));
        $this->assertSame(37, $this->converter->prefectureIdByKatakanaName('カガワケン'));
        $this->assertSame(38, $this->converter->prefectureIdByKatakanaName('エヒメケン'));
        $this->assertSame(39, $this->converter->prefectureIdByKatakanaName('コウチケン'));
        $this->assertSame(40, $this->converter->prefectureIdByKatakanaName('フクオカケン'));
        $this->assertSame(41, $this->converter->prefectureIdByKatakanaName('サガケン'));
        $this->assertSame(42, $this->converter->prefectureIdByKatakanaName('ナガサキケン'));
        $this->assertSame(43, $this->converter->prefectureIdByKatakanaName('クマモトケン'));
        $this->assertSame(44, $this->converter->prefectureIdByKatakanaName('オオイタケン'));
        $this->assertSame(45, $this->converter->prefectureIdByKatakanaName('ミヤザキケン'));
        $this->assertSame(46, $this->converter->prefectureIdByKatakanaName('カゴシマケン'));
        $this->assertSame(47, $this->converter->prefectureIdByKatakanaName('オキナワケン'));
        $this->assertNull($this->converter->prefectureIdByKatakanaName('キョウテイ'));
        $this->assertNull($this->converter->prefectureIdByKatakanaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureIdByEnglishName(): void
    {
        $this->assertSame(1, $this->converter->prefectureIdByEnglishName('hokkaido'));
        $this->assertSame(2, $this->converter->prefectureIdByEnglishName('aomori'));
        $this->assertSame(3, $this->converter->prefectureIdByEnglishName('iwate'));
        $this->assertSame(4, $this->converter->prefectureIdByEnglishName('miyagi'));
        $this->assertSame(5, $this->converter->prefectureIdByEnglishName('akita'));
        $this->assertSame(6, $this->converter->prefectureIdByEnglishName('yamagata'));
        $this->assertSame(7, $this->converter->prefectureIdByEnglishName('fukushima'));
        $this->assertSame(8, $this->converter->prefectureIdByEnglishName('ibaraki'));
        $this->assertSame(9, $this->converter->prefectureIdByEnglishName('tochigi'));
        $this->assertSame(10, $this->converter->prefectureIdByEnglishName('gunma'));
        $this->assertSame(11, $this->converter->prefectureIdByEnglishName('saitama'));
        $this->assertSame(12, $this->converter->prefectureIdByEnglishName('chiba'));
        $this->assertSame(13, $this->converter->prefectureIdByEnglishName('tokyo'));
        $this->assertSame(14, $this->converter->prefectureIdByEnglishName('kanagawa'));
        $this->assertSame(15, $this->converter->prefectureIdByEnglishName('niigata'));
        $this->assertSame(16, $this->converter->prefectureIdByEnglishName('toyama'));
        $this->assertSame(17, $this->converter->prefectureIdByEnglishName('ishikawa'));
        $this->assertSame(18, $this->converter->prefectureIdByEnglishName('fukui'));
        $this->assertSame(19, $this->converter->prefectureIdByEnglishName('yamanashi'));
        $this->assertSame(20, $this->converter->prefectureIdByEnglishName('nagano'));
        $this->assertSame(21, $this->converter->prefectureIdByEnglishName('gifu'));
        $this->assertSame(22, $this->converter->prefectureIdByEnglishName('shizuoka'));
        $this->assertSame(23, $this->converter->prefectureIdByEnglishName('aichi'));
        $this->assertSame(24, $this->converter->prefectureIdByEnglishName('mie'));
        $this->assertSame(25, $this->converter->prefectureIdByEnglishName('shiga'));
        $this->assertSame(26, $this->converter->prefectureIdByEnglishName('kyoto'));
        $this->assertSame(27, $this->converter->prefectureIdByEnglishName('osaka'));
        $this->assertSame(28, $this->converter->prefectureIdByEnglishName('hyogo'));
        $this->assertSame(29, $this->converter->prefectureIdByEnglishName('nara'));
        $this->assertSame(30, $this->converter->prefectureIdByEnglishName('wakayama'));
        $this->assertSame(31, $this->converter->prefectureIdByEnglishName('tottori'));
        $this->assertSame(32, $this->converter->prefectureIdByEnglishName('shimane'));
        $this->assertSame(33, $this->converter->prefectureIdByEnglishName('okayama'));
        $this->assertSame(34, $this->converter->prefectureIdByEnglishName('hiroshima'));
        $this->assertSame(35, $this->converter->prefectureIdByEnglishName('yamaguchi'));
        $this->assertSame(36, $this->converter->prefectureIdByEnglishName('tokushima'));
        $this->assertSame(37, $this->converter->prefectureIdByEnglishName('kagawa'));
        $this->assertSame(38, $this->converter->prefectureIdByEnglishName('ehime'));
        $this->assertSame(39, $this->converter->prefectureIdByEnglishName('kochi'));
        $this->assertSame(40, $this->converter->prefectureIdByEnglishName('fukuoka'));
        $this->assertSame(41, $this->converter->prefectureIdByEnglishName('saga'));
        $this->assertSame(42, $this->converter->prefectureIdByEnglishName('nagasaki'));
        $this->assertSame(43, $this->converter->prefectureIdByEnglishName('kumamoto'));
        $this->assertSame(44, $this->converter->prefectureIdByEnglishName('oita'));
        $this->assertSame(45, $this->converter->prefectureIdByEnglishName('miyazaki'));
        $this->assertSame(46, $this->converter->prefectureIdByEnglishName('kagoshima'));
        $this->assertSame(47, $this->converter->prefectureIdByEnglishName('okinawa'));
        $this->assertNull($this->converter->prefectureIdByEnglishName('kyotei'));
        $this->assertNull($this->converter->prefectureIdByEnglishName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureNameById(): void
    {
        $this->assertSame('北海道', $this->converter->prefectureNameById(1));
        $this->assertSame('青森県', $this->converter->prefectureNameById(2));
        $this->assertSame('岩手県', $this->converter->prefectureNameById(3));
        $this->assertSame('宮城県', $this->converter->prefectureNameById(4));
        $this->assertSame('秋田県', $this->converter->prefectureNameById(5));
        $this->assertSame('山形県', $this->converter->prefectureNameById(6));
        $this->assertSame('福島県', $this->converter->prefectureNameById(7));
        $this->assertSame('茨城県', $this->converter->prefectureNameById(8));
        $this->assertSame('栃木県', $this->converter->prefectureNameById(9));
        $this->assertSame('群馬県', $this->converter->prefectureNameById(10));
        $this->assertSame('埼玉県', $this->converter->prefectureNameById(11));
        $this->assertSame('千葉県', $this->converter->prefectureNameById(12));
        $this->assertSame('東京都', $this->converter->prefectureNameById(13));
        $this->assertSame('神奈川県', $this->converter->prefectureNameById(14));
        $this->assertSame('新潟県', $this->converter->prefectureNameById(15));
        $this->assertSame('富山県', $this->converter->prefectureNameById(16));
        $this->assertSame('石川県', $this->converter->prefectureNameById(17));
        $this->assertSame('福井県', $this->converter->prefectureNameById(18));
        $this->assertSame('山梨県', $this->converter->prefectureNameById(19));
        $this->assertSame('長野県', $this->converter->prefectureNameById(20));
        $this->assertSame('岐阜県', $this->converter->prefectureNameById(21));
        $this->assertSame('静岡県', $this->converter->prefectureNameById(22));
        $this->assertSame('愛知県', $this->converter->prefectureNameById(23));
        $this->assertSame('三重県', $this->converter->prefectureNameById(24));
        $this->assertSame('滋賀県', $this->converter->prefectureNameById(25));
        $this->assertSame('京都府', $this->converter->prefectureNameById(26));
        $this->assertSame('大阪府', $this->converter->prefectureNameById(27));
        $this->assertSame('兵庫県', $this->converter->prefectureNameById(28));
        $this->assertSame('奈良県', $this->converter->prefectureNameById(29));
        $this->assertSame('和歌山県', $this->converter->prefectureNameById(30));
        $this->assertSame('鳥取県', $this->converter->prefectureNameById(31));
        $this->assertSame('島根県', $this->converter->prefectureNameById(32));
        $this->assertSame('岡山県', $this->converter->prefectureNameById(33));
        $this->assertSame('広島県', $this->converter->prefectureNameById(34));
        $this->assertSame('山口県', $this->converter->prefectureNameById(35));
        $this->assertSame('徳島県', $this->converter->prefectureNameById(36));
        $this->assertSame('香川県', $this->converter->prefectureNameById(37));
        $this->assertSame('愛媛県', $this->converter->prefectureNameById(38));
        $this->assertSame('高知県', $this->converter->prefectureNameById(39));
        $this->assertSame('福岡県', $this->converter->prefectureNameById(40));
        $this->assertSame('佐賀県', $this->converter->prefectureNameById(41));
        $this->assertSame('長崎県', $this->converter->prefectureNameById(42));
        $this->assertSame('熊本県', $this->converter->prefectureNameById(43));
        $this->assertSame('大分県', $this->converter->prefectureNameById(44));
        $this->assertSame('宮崎県', $this->converter->prefectureNameById(45));
        $this->assertSame('鹿児島県', $this->converter->prefectureNameById(46));
        $this->assertSame('沖縄県', $this->converter->prefectureNameById(47));
        $this->assertNull($this->converter->prefectureNameById(48));
        $this->assertNull($this->converter->prefectureNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureNameByShortName(): void
    {
        $this->assertSame('北海道', $this->converter->prefectureNameByShortName('北海道'));
        $this->assertSame('青森県', $this->converter->prefectureNameByShortName('青森'));
        $this->assertSame('岩手県', $this->converter->prefectureNameByShortName('岩手'));
        $this->assertSame('宮城県', $this->converter->prefectureNameByShortName('宮城'));
        $this->assertSame('秋田県', $this->converter->prefectureNameByShortName('秋田'));
        $this->assertSame('山形県', $this->converter->prefectureNameByShortName('山形'));
        $this->assertSame('福島県', $this->converter->prefectureNameByShortName('福島'));
        $this->assertSame('茨城県', $this->converter->prefectureNameByShortName('茨城'));
        $this->assertSame('栃木県', $this->converter->prefectureNameByShortName('栃木'));
        $this->assertSame('群馬県', $this->converter->prefectureNameByShortName('群馬'));
        $this->assertSame('埼玉県', $this->converter->prefectureNameByShortName('埼玉'));
        $this->assertSame('千葉県', $this->converter->prefectureNameByShortName('千葉'));
        $this->assertSame('東京都', $this->converter->prefectureNameByShortName('東京'));
        $this->assertSame('神奈川県', $this->converter->prefectureNameByShortName('神奈川'));
        $this->assertSame('新潟県', $this->converter->prefectureNameByShortName('新潟'));
        $this->assertSame('富山県', $this->converter->prefectureNameByShortName('富山'));
        $this->assertSame('石川県', $this->converter->prefectureNameByShortName('石川'));
        $this->assertSame('福井県', $this->converter->prefectureNameByShortName('福井'));
        $this->assertSame('山梨県', $this->converter->prefectureNameByShortName('山梨'));
        $this->assertSame('長野県', $this->converter->prefectureNameByShortName('長野'));
        $this->assertSame('岐阜県', $this->converter->prefectureNameByShortName('岐阜'));
        $this->assertSame('静岡県', $this->converter->prefectureNameByShortName('静岡'));
        $this->assertSame('愛知県', $this->converter->prefectureNameByShortName('愛知'));
        $this->assertSame('三重県', $this->converter->prefectureNameByShortName('三重'));
        $this->assertSame('滋賀県', $this->converter->prefectureNameByShortName('滋賀'));
        $this->assertSame('京都府', $this->converter->prefectureNameByShortName('京都'));
        $this->assertSame('大阪府', $this->converter->prefectureNameByShortName('大阪'));
        $this->assertSame('兵庫県', $this->converter->prefectureNameByShortName('兵庫'));
        $this->assertSame('奈良県', $this->converter->prefectureNameByShortName('奈良'));
        $this->assertSame('和歌山県', $this->converter->prefectureNameByShortName('和歌山'));
        $this->assertSame('鳥取県', $this->converter->prefectureNameByShortName('鳥取'));
        $this->assertSame('島根県', $this->converter->prefectureNameByShortName('島根'));
        $this->assertSame('岡山県', $this->converter->prefectureNameByShortName('岡山'));
        $this->assertSame('広島県', $this->converter->prefectureNameByShortName('広島'));
        $this->assertSame('山口県', $this->converter->prefectureNameByShortName('山口'));
        $this->assertSame('徳島県', $this->converter->prefectureNameByShortName('徳島'));
        $this->assertSame('香川県', $this->converter->prefectureNameByShortName('香川'));
        $this->assertSame('愛媛県', $this->converter->prefectureNameByShortName('愛媛'));
        $this->assertSame('高知県', $this->converter->prefectureNameByShortName('高知'));
        $this->assertSame('福岡県', $this->converter->prefectureNameByShortName('福岡'));
        $this->assertSame('佐賀県', $this->converter->prefectureNameByShortName('佐賀'));
        $this->assertSame('長崎県', $this->converter->prefectureNameByShortName('長崎'));
        $this->assertSame('熊本県', $this->converter->prefectureNameByShortName('熊本'));
        $this->assertSame('大分県', $this->converter->prefectureNameByShortName('大分'));
        $this->assertSame('宮崎県', $this->converter->prefectureNameByShortName('宮崎'));
        $this->assertSame('鹿児島県', $this->converter->prefectureNameByShortName('鹿児島'));
        $this->assertSame('沖縄県', $this->converter->prefectureNameByShortName('沖縄'));
        $this->assertNull($this->converter->prefectureNameByShortName('競艇'));
        $this->assertNull($this->converter->prefectureNameByShortName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureNameByHiraganaName(): void
    {
        $this->assertSame('北海道', $this->converter->prefectureNameByHiraganaName('ほっかいどう'));
        $this->assertSame('青森県', $this->converter->prefectureNameByHiraganaName('あおもりけん'));
        $this->assertSame('岩手県', $this->converter->prefectureNameByHiraganaName('いわてけん'));
        $this->assertSame('宮城県', $this->converter->prefectureNameByHiraganaName('みやぎけん'));
        $this->assertSame('秋田県', $this->converter->prefectureNameByHiraganaName('あきたけん'));
        $this->assertSame('山形県', $this->converter->prefectureNameByHiraganaName('やまがたけん'));
        $this->assertSame('福島県', $this->converter->prefectureNameByHiraganaName('ふくしまけん'));
        $this->assertSame('茨城県', $this->converter->prefectureNameByHiraganaName('いばらきけん'));
        $this->assertSame('栃木県', $this->converter->prefectureNameByHiraganaName('とちぎけん'));
        $this->assertSame('群馬県', $this->converter->prefectureNameByHiraganaName('ぐんまけん'));
        $this->assertSame('埼玉県', $this->converter->prefectureNameByHiraganaName('さいたまけん'));
        $this->assertSame('千葉県', $this->converter->prefectureNameByHiraganaName('ちばけん'));
        $this->assertSame('東京都', $this->converter->prefectureNameByHiraganaName('とうきょうと'));
        $this->assertSame('神奈川県', $this->converter->prefectureNameByHiraganaName('かながわけん'));
        $this->assertSame('新潟県', $this->converter->prefectureNameByHiraganaName('にいがたけん'));
        $this->assertSame('富山県', $this->converter->prefectureNameByHiraganaName('とやまけん'));
        $this->assertSame('石川県', $this->converter->prefectureNameByHiraganaName('いしかわけん'));
        $this->assertSame('福井県', $this->converter->prefectureNameByHiraganaName('ふくいけん'));
        $this->assertSame('山梨県', $this->converter->prefectureNameByHiraganaName('やまなしけん'));
        $this->assertSame('長野県', $this->converter->prefectureNameByHiraganaName('ながのけん'));
        $this->assertSame('岐阜県', $this->converter->prefectureNameByHiraganaName('ぎふけん'));
        $this->assertSame('静岡県', $this->converter->prefectureNameByHiraganaName('しずおかけん'));
        $this->assertSame('愛知県', $this->converter->prefectureNameByHiraganaName('あいちけん'));
        $this->assertSame('三重県', $this->converter->prefectureNameByHiraganaName('みえけん'));
        $this->assertSame('滋賀県', $this->converter->prefectureNameByHiraganaName('しがけん'));
        $this->assertSame('京都府', $this->converter->prefectureNameByHiraganaName('きょうとふ'));
        $this->assertSame('大阪府', $this->converter->prefectureNameByHiraganaName('おおさかふ'));
        $this->assertSame('兵庫県', $this->converter->prefectureNameByHiraganaName('ひょうごけん'));
        $this->assertSame('奈良県', $this->converter->prefectureNameByHiraganaName('ならけん'));
        $this->assertSame('和歌山県', $this->converter->prefectureNameByHiraganaName('わかやまけん'));
        $this->assertSame('鳥取県', $this->converter->prefectureNameByHiraganaName('とっとりけん'));
        $this->assertSame('島根県', $this->converter->prefectureNameByHiraganaName('しまねけん'));
        $this->assertSame('岡山県', $this->converter->prefectureNameByHiraganaName('おかやまけん'));
        $this->assertSame('広島県', $this->converter->prefectureNameByHiraganaName('ひろしまけん'));
        $this->assertSame('山口県', $this->converter->prefectureNameByHiraganaName('やまぐちけん'));
        $this->assertSame('徳島県', $this->converter->prefectureNameByHiraganaName('とくしまけん'));
        $this->assertSame('香川県', $this->converter->prefectureNameByHiraganaName('かがわけん'));
        $this->assertSame('愛媛県', $this->converter->prefectureNameByHiraganaName('えひめけん'));
        $this->assertSame('高知県', $this->converter->prefectureNameByHiraganaName('こうちけん'));
        $this->assertSame('福岡県', $this->converter->prefectureNameByHiraganaName('ふくおかけん'));
        $this->assertSame('佐賀県', $this->converter->prefectureNameByHiraganaName('さがけん'));
        $this->assertSame('長崎県', $this->converter->prefectureNameByHiraganaName('ながさきけん'));
        $this->assertSame('熊本県', $this->converter->prefectureNameByHiraganaName('くまもとけん'));
        $this->assertSame('大分県', $this->converter->prefectureNameByHiraganaName('おおいたけん'));
        $this->assertSame('宮崎県', $this->converter->prefectureNameByHiraganaName('みやざきけん'));
        $this->assertSame('鹿児島県', $this->converter->prefectureNameByHiraganaName('かごしまけん'));
        $this->assertSame('沖縄県', $this->converter->prefectureNameByHiraganaName('おきなわけん'));
        $this->assertNull($this->converter->prefectureNameByHiraganaName('きょうてい'));
        $this->assertNull($this->converter->prefectureNameByHiraganaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureNameByKatakanaName(): void
    {
        $this->assertSame('北海道', $this->converter->prefectureNameByKatakanaName('ホッカイドウ'));
        $this->assertSame('青森県', $this->converter->prefectureNameByKatakanaName('アオモリケン'));
        $this->assertSame('岩手県', $this->converter->prefectureNameByKatakanaName('イワテケン'));
        $this->assertSame('宮城県', $this->converter->prefectureNameByKatakanaName('ミヤギケン'));
        $this->assertSame('秋田県', $this->converter->prefectureNameByKatakanaName('アキタケン'));
        $this->assertSame('山形県', $this->converter->prefectureNameByKatakanaName('ヤマガタケン'));
        $this->assertSame('福島県', $this->converter->prefectureNameByKatakanaName('フクシマケン'));
        $this->assertSame('茨城県', $this->converter->prefectureNameByKatakanaName('イバラキケン'));
        $this->assertSame('栃木県', $this->converter->prefectureNameByKatakanaName('トチギケン'));
        $this->assertSame('群馬県', $this->converter->prefectureNameByKatakanaName('グンマケン'));
        $this->assertSame('埼玉県', $this->converter->prefectureNameByKatakanaName('サイタマケン'));
        $this->assertSame('千葉県', $this->converter->prefectureNameByKatakanaName('チバケン'));
        $this->assertSame('東京都', $this->converter->prefectureNameByKatakanaName('トウキョウト'));
        $this->assertSame('神奈川県', $this->converter->prefectureNameByKatakanaName('カナガワケン'));
        $this->assertSame('新潟県', $this->converter->prefectureNameByKatakanaName('ニイガタケン'));
        $this->assertSame('富山県', $this->converter->prefectureNameByKatakanaName('トヤマケン'));
        $this->assertSame('石川県', $this->converter->prefectureNameByKatakanaName('イシカワケン'));
        $this->assertSame('福井県', $this->converter->prefectureNameByKatakanaName('フクイケン'));
        $this->assertSame('山梨県', $this->converter->prefectureNameByKatakanaName('ヤマナシケン'));
        $this->assertSame('長野県', $this->converter->prefectureNameByKatakanaName('ナガノケン'));
        $this->assertSame('岐阜県', $this->converter->prefectureNameByKatakanaName('ギフケン'));
        $this->assertSame('静岡県', $this->converter->prefectureNameByKatakanaName('シズオカケン'));
        $this->assertSame('愛知県', $this->converter->prefectureNameByKatakanaName('アイチケン'));
        $this->assertSame('三重県', $this->converter->prefectureNameByKatakanaName('ミエケン'));
        $this->assertSame('滋賀県', $this->converter->prefectureNameByKatakanaName('シガケン'));
        $this->assertSame('京都府', $this->converter->prefectureNameByKatakanaName('キョウトフ'));
        $this->assertSame('大阪府', $this->converter->prefectureNameByKatakanaName('オオサカフ'));
        $this->assertSame('兵庫県', $this->converter->prefectureNameByKatakanaName('ヒョウゴケン'));
        $this->assertSame('奈良県', $this->converter->prefectureNameByKatakanaName('ナラケン'));
        $this->assertSame('和歌山県', $this->converter->prefectureNameByKatakanaName('ワカヤマケン'));
        $this->assertSame('鳥取県', $this->converter->prefectureNameByKatakanaName('トットリケン'));
        $this->assertSame('島根県', $this->converter->prefectureNameByKatakanaName('シマネケン'));
        $this->assertSame('岡山県', $this->converter->prefectureNameByKatakanaName('オカヤマケン'));
        $this->assertSame('広島県', $this->converter->prefectureNameByKatakanaName('ヒロシマケン'));
        $this->assertSame('山口県', $this->converter->prefectureNameByKatakanaName('ヤマグチケン'));
        $this->assertSame('徳島県', $this->converter->prefectureNameByKatakanaName('トクシマケン'));
        $this->assertSame('香川県', $this->converter->prefectureNameByKatakanaName('カガワケン'));
        $this->assertSame('愛媛県', $this->converter->prefectureNameByKatakanaName('エヒメケン'));
        $this->assertSame('高知県', $this->converter->prefectureNameByKatakanaName('コウチケン'));
        $this->assertSame('福岡県', $this->converter->prefectureNameByKatakanaName('フクオカケン'));
        $this->assertSame('佐賀県', $this->converter->prefectureNameByKatakanaName('サガケン'));
        $this->assertSame('長崎県', $this->converter->prefectureNameByKatakanaName('ナガサキケン'));
        $this->assertSame('熊本県', $this->converter->prefectureNameByKatakanaName('クマモトケン'));
        $this->assertSame('大分県', $this->converter->prefectureNameByKatakanaName('オオイタケン'));
        $this->assertSame('宮崎県', $this->converter->prefectureNameByKatakanaName('ミヤザキケン'));
        $this->assertSame('鹿児島県', $this->converter->prefectureNameByKatakanaName('カゴシマケン'));
        $this->assertSame('沖縄県', $this->converter->prefectureNameByKatakanaName('オキナワケン'));
        $this->assertNull($this->converter->prefectureNameByKatakanaName('キョウテイ'));
        $this->assertNull($this->converter->prefectureNameByKatakanaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureNameByEnglishName(): void
    {
        $this->assertSame('北海道', $this->converter->prefectureNameByEnglishName('hokkaido'));
        $this->assertSame('青森県', $this->converter->prefectureNameByEnglishName('aomori'));
        $this->assertSame('岩手県', $this->converter->prefectureNameByEnglishName('iwate'));
        $this->assertSame('宮城県', $this->converter->prefectureNameByEnglishName('miyagi'));
        $this->assertSame('秋田県', $this->converter->prefectureNameByEnglishName('akita'));
        $this->assertSame('山形県', $this->converter->prefectureNameByEnglishName('yamagata'));
        $this->assertSame('福島県', $this->converter->prefectureNameByEnglishName('fukushima'));
        $this->assertSame('茨城県', $this->converter->prefectureNameByEnglishName('ibaraki'));
        $this->assertSame('栃木県', $this->converter->prefectureNameByEnglishName('tochigi'));
        $this->assertSame('群馬県', $this->converter->prefectureNameByEnglishName('gunma'));
        $this->assertSame('埼玉県', $this->converter->prefectureNameByEnglishName('saitama'));
        $this->assertSame('千葉県', $this->converter->prefectureNameByEnglishName('chiba'));
        $this->assertSame('東京都', $this->converter->prefectureNameByEnglishName('tokyo'));
        $this->assertSame('神奈川県', $this->converter->prefectureNameByEnglishName('kanagawa'));
        $this->assertSame('新潟県', $this->converter->prefectureNameByEnglishName('niigata'));
        $this->assertSame('富山県', $this->converter->prefectureNameByEnglishName('toyama'));
        $this->assertSame('石川県', $this->converter->prefectureNameByEnglishName('ishikawa'));
        $this->assertSame('福井県', $this->converter->prefectureNameByEnglishName('fukui'));
        $this->assertSame('山梨県', $this->converter->prefectureNameByEnglishName('yamanashi'));
        $this->assertSame('長野県', $this->converter->prefectureNameByEnglishName('nagano'));
        $this->assertSame('岐阜県', $this->converter->prefectureNameByEnglishName('gifu'));
        $this->assertSame('静岡県', $this->converter->prefectureNameByEnglishName('shizuoka'));
        $this->assertSame('愛知県', $this->converter->prefectureNameByEnglishName('aichi'));
        $this->assertSame('三重県', $this->converter->prefectureNameByEnglishName('mie'));
        $this->assertSame('滋賀県', $this->converter->prefectureNameByEnglishName('shiga'));
        $this->assertSame('京都府', $this->converter->prefectureNameByEnglishName('kyoto'));
        $this->assertSame('大阪府', $this->converter->prefectureNameByEnglishName('osaka'));
        $this->assertSame('兵庫県', $this->converter->prefectureNameByEnglishName('hyogo'));
        $this->assertSame('奈良県', $this->converter->prefectureNameByEnglishName('nara'));
        $this->assertSame('和歌山県', $this->converter->prefectureNameByEnglishName('wakayama'));
        $this->assertSame('鳥取県', $this->converter->prefectureNameByEnglishName('tottori'));
        $this->assertSame('島根県', $this->converter->prefectureNameByEnglishName('shimane'));
        $this->assertSame('岡山県', $this->converter->prefectureNameByEnglishName('okayama'));
        $this->assertSame('広島県', $this->converter->prefectureNameByEnglishName('hiroshima'));
        $this->assertSame('山口県', $this->converter->prefectureNameByEnglishName('yamaguchi'));
        $this->assertSame('徳島県', $this->converter->prefectureNameByEnglishName('tokushima'));
        $this->assertSame('香川県', $this->converter->prefectureNameByEnglishName('kagawa'));
        $this->assertSame('愛媛県', $this->converter->prefectureNameByEnglishName('ehime'));
        $this->assertSame('高知県', $this->converter->prefectureNameByEnglishName('kochi'));
        $this->assertSame('福岡県', $this->converter->prefectureNameByEnglishName('fukuoka'));
        $this->assertSame('佐賀県', $this->converter->prefectureNameByEnglishName('saga'));
        $this->assertSame('長崎県', $this->converter->prefectureNameByEnglishName('nagasaki'));
        $this->assertSame('熊本県', $this->converter->prefectureNameByEnglishName('kumamoto'));
        $this->assertSame('大分県', $this->converter->prefectureNameByEnglishName('oita'));
        $this->assertSame('宮崎県', $this->converter->prefectureNameByEnglishName('miyazaki'));
        $this->assertSame('鹿児島県', $this->converter->prefectureNameByEnglishName('kagoshima'));
        $this->assertSame('沖縄県', $this->converter->prefectureNameByEnglishName('okinawa'));
        $this->assertNull($this->converter->prefectureNameByEnglishName('kyotei'));
        $this->assertNull($this->converter->prefectureNameByEnglishName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureShortNameById(): void
    {
        $this->assertSame('北海道', $this->converter->prefectureShortNameById(1));
        $this->assertSame('青森', $this->converter->prefectureShortNameById(2));
        $this->assertSame('岩手', $this->converter->prefectureShortNameById(3));
        $this->assertSame('宮城', $this->converter->prefectureShortNameById(4));
        $this->assertSame('秋田', $this->converter->prefectureShortNameById(5));
        $this->assertSame('山形', $this->converter->prefectureShortNameById(6));
        $this->assertSame('福島', $this->converter->prefectureShortNameById(7));
        $this->assertSame('茨城', $this->converter->prefectureShortNameById(8));
        $this->assertSame('栃木', $this->converter->prefectureShortNameById(9));
        $this->assertSame('群馬', $this->converter->prefectureShortNameById(10));
        $this->assertSame('埼玉', $this->converter->prefectureShortNameById(11));
        $this->assertSame('千葉', $this->converter->prefectureShortNameById(12));
        $this->assertSame('東京', $this->converter->prefectureShortNameById(13));
        $this->assertSame('神奈川', $this->converter->prefectureShortNameById(14));
        $this->assertSame('新潟', $this->converter->prefectureShortNameById(15));
        $this->assertSame('富山', $this->converter->prefectureShortNameById(16));
        $this->assertSame('石川', $this->converter->prefectureShortNameById(17));
        $this->assertSame('福井', $this->converter->prefectureShortNameById(18));
        $this->assertSame('山梨', $this->converter->prefectureShortNameById(19));
        $this->assertSame('長野', $this->converter->prefectureShortNameById(20));
        $this->assertSame('岐阜', $this->converter->prefectureShortNameById(21));
        $this->assertSame('静岡', $this->converter->prefectureShortNameById(22));
        $this->assertSame('愛知', $this->converter->prefectureShortNameById(23));
        $this->assertSame('三重', $this->converter->prefectureShortNameById(24));
        $this->assertSame('滋賀', $this->converter->prefectureShortNameById(25));
        $this->assertSame('京都', $this->converter->prefectureShortNameById(26));
        $this->assertSame('大阪', $this->converter->prefectureShortNameById(27));
        $this->assertSame('兵庫', $this->converter->prefectureShortNameById(28));
        $this->assertSame('奈良', $this->converter->prefectureShortNameById(29));
        $this->assertSame('和歌山', $this->converter->prefectureShortNameById(30));
        $this->assertSame('鳥取', $this->converter->prefectureShortNameById(31));
        $this->assertSame('島根', $this->converter->prefectureShortNameById(32));
        $this->assertSame('岡山', $this->converter->prefectureShortNameById(33));
        $this->assertSame('広島', $this->converter->prefectureShortNameById(34));
        $this->assertSame('山口', $this->converter->prefectureShortNameById(35));
        $this->assertSame('徳島', $this->converter->prefectureShortNameById(36));
        $this->assertSame('香川', $this->converter->prefectureShortNameById(37));
        $this->assertSame('愛媛', $this->converter->prefectureShortNameById(38));
        $this->assertSame('高知', $this->converter->prefectureShortNameById(39));
        $this->assertSame('福岡', $this->converter->prefectureShortNameById(40));
        $this->assertSame('佐賀', $this->converter->prefectureShortNameById(41));
        $this->assertSame('長崎', $this->converter->prefectureShortNameById(42));
        $this->assertSame('熊本', $this->converter->prefectureShortNameById(43));
        $this->assertSame('大分', $this->converter->prefectureShortNameById(44));
        $this->assertSame('宮崎', $this->converter->prefectureShortNameById(45));
        $this->assertSame('鹿児島', $this->converter->prefectureShortNameById(46));
        $this->assertSame('沖縄', $this->converter->prefectureShortNameById(47));
        $this->assertNull($this->converter->prefectureShortNameById(48));
        $this->assertNull($this->converter->prefectureShortNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureShortNameByName(): void
    {
        $this->assertSame('北海道', $this->converter->prefectureShortNameByName('北海道'));
        $this->assertSame('青森', $this->converter->prefectureShortNameByName('青森県'));
        $this->assertSame('岩手', $this->converter->prefectureShortNameByName('岩手県'));
        $this->assertSame('宮城', $this->converter->prefectureShortNameByName('宮城県'));
        $this->assertSame('秋田', $this->converter->prefectureShortNameByName('秋田県'));
        $this->assertSame('山形', $this->converter->prefectureShortNameByName('山形県'));
        $this->assertSame('福島', $this->converter->prefectureShortNameByName('福島県'));
        $this->assertSame('茨城', $this->converter->prefectureShortNameByName('茨城県'));
        $this->assertSame('栃木', $this->converter->prefectureShortNameByName('栃木県'));
        $this->assertSame('群馬', $this->converter->prefectureShortNameByName('群馬県'));
        $this->assertSame('埼玉', $this->converter->prefectureShortNameByName('埼玉県'));
        $this->assertSame('千葉', $this->converter->prefectureShortNameByName('千葉県'));
        $this->assertSame('東京', $this->converter->prefectureShortNameByName('東京都'));
        $this->assertSame('神奈川', $this->converter->prefectureShortNameByName('神奈川県'));
        $this->assertSame('新潟', $this->converter->prefectureShortNameByName('新潟県'));
        $this->assertSame('富山', $this->converter->prefectureShortNameByName('富山県'));
        $this->assertSame('石川', $this->converter->prefectureShortNameByName('石川県'));
        $this->assertSame('福井', $this->converter->prefectureShortNameByName('福井県'));
        $this->assertSame('山梨', $this->converter->prefectureShortNameByName('山梨県'));
        $this->assertSame('長野', $this->converter->prefectureShortNameByName('長野県'));
        $this->assertSame('岐阜', $this->converter->prefectureShortNameByName('岐阜県'));
        $this->assertSame('静岡', $this->converter->prefectureShortNameByName('静岡県'));
        $this->assertSame('愛知', $this->converter->prefectureShortNameByName('愛知県'));
        $this->assertSame('三重', $this->converter->prefectureShortNameByName('三重県'));
        $this->assertSame('滋賀', $this->converter->prefectureShortNameByName('滋賀県'));
        $this->assertSame('京都', $this->converter->prefectureShortNameByName('京都府'));
        $this->assertSame('大阪', $this->converter->prefectureShortNameByName('大阪府'));
        $this->assertSame('兵庫', $this->converter->prefectureShortNameByName('兵庫県'));
        $this->assertSame('奈良', $this->converter->prefectureShortNameByName('奈良県'));
        $this->assertSame('和歌山', $this->converter->prefectureShortNameByName('和歌山県'));
        $this->assertSame('鳥取', $this->converter->prefectureShortNameByName('鳥取県'));
        $this->assertSame('島根', $this->converter->prefectureShortNameByName('島根県'));
        $this->assertSame('岡山', $this->converter->prefectureShortNameByName('岡山県'));
        $this->assertSame('広島', $this->converter->prefectureShortNameByName('広島県'));
        $this->assertSame('山口', $this->converter->prefectureShortNameByName('山口県'));
        $this->assertSame('徳島', $this->converter->prefectureShortNameByName('徳島県'));
        $this->assertSame('香川', $this->converter->prefectureShortNameByName('香川県'));
        $this->assertSame('愛媛', $this->converter->prefectureShortNameByName('愛媛県'));
        $this->assertSame('高知', $this->converter->prefectureShortNameByName('高知県'));
        $this->assertSame('福岡', $this->converter->prefectureShortNameByName('福岡県'));
        $this->assertSame('佐賀', $this->converter->prefectureShortNameByName('佐賀県'));
        $this->assertSame('長崎', $this->converter->prefectureShortNameByName('長崎県'));
        $this->assertSame('熊本', $this->converter->prefectureShortNameByName('熊本県'));
        $this->assertSame('大分', $this->converter->prefectureShortNameByName('大分県'));
        $this->assertSame('宮崎', $this->converter->prefectureShortNameByName('宮崎県'));
        $this->assertSame('鹿児島', $this->converter->prefectureShortNameByName('鹿児島県'));
        $this->assertSame('沖縄', $this->converter->prefectureShortNameByName('沖縄県'));
        $this->assertNull($this->converter->prefectureShortNameByName('競艇'));
        $this->assertNull($this->converter->prefectureShortNameByName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureShortNameByHiraganaName(): void
    {
        $this->assertSame('北海道', $this->converter->prefectureShortNameByHiraganaName('ほっかいどう'));
        $this->assertSame('青森', $this->converter->prefectureShortNameByHiraganaName('あおもりけん'));
        $this->assertSame('岩手', $this->converter->prefectureShortNameByHiraganaName('いわてけん'));
        $this->assertSame('宮城', $this->converter->prefectureShortNameByHiraganaName('みやぎけん'));
        $this->assertSame('秋田', $this->converter->prefectureShortNameByHiraganaName('あきたけん'));
        $this->assertSame('山形', $this->converter->prefectureShortNameByHiraganaName('やまがたけん'));
        $this->assertSame('福島', $this->converter->prefectureShortNameByHiraganaName('ふくしまけん'));
        $this->assertSame('茨城', $this->converter->prefectureShortNameByHiraganaName('いばらきけん'));
        $this->assertSame('栃木', $this->converter->prefectureShortNameByHiraganaName('とちぎけん'));
        $this->assertSame('群馬', $this->converter->prefectureShortNameByHiraganaName('ぐんまけん'));
        $this->assertSame('埼玉', $this->converter->prefectureShortNameByHiraganaName('さいたまけん'));
        $this->assertSame('千葉', $this->converter->prefectureShortNameByHiraganaName('ちばけん'));
        $this->assertSame('東京', $this->converter->prefectureShortNameByHiraganaName('とうきょうと'));
        $this->assertSame('神奈川', $this->converter->prefectureShortNameByHiraganaName('かながわけん'));
        $this->assertSame('新潟', $this->converter->prefectureShortNameByHiraganaName('にいがたけん'));
        $this->assertSame('富山', $this->converter->prefectureShortNameByHiraganaName('とやまけん'));
        $this->assertSame('石川', $this->converter->prefectureShortNameByHiraganaName('いしかわけん'));
        $this->assertSame('福井', $this->converter->prefectureShortNameByHiraganaName('ふくいけん'));
        $this->assertSame('山梨', $this->converter->prefectureShortNameByHiraganaName('やまなしけん'));
        $this->assertSame('長野', $this->converter->prefectureShortNameByHiraganaName('ながのけん'));
        $this->assertSame('岐阜', $this->converter->prefectureShortNameByHiraganaName('ぎふけん'));
        $this->assertSame('静岡', $this->converter->prefectureShortNameByHiraganaName('しずおかけん'));
        $this->assertSame('愛知', $this->converter->prefectureShortNameByHiraganaName('あいちけん'));
        $this->assertSame('三重', $this->converter->prefectureShortNameByHiraganaName('みえけん'));
        $this->assertSame('滋賀', $this->converter->prefectureShortNameByHiraganaName('しがけん'));
        $this->assertSame('京都', $this->converter->prefectureShortNameByHiraganaName('きょうとふ'));
        $this->assertSame('大阪', $this->converter->prefectureShortNameByHiraganaName('おおさかふ'));
        $this->assertSame('兵庫', $this->converter->prefectureShortNameByHiraganaName('ひょうごけん'));
        $this->assertSame('奈良', $this->converter->prefectureShortNameByHiraganaName('ならけん'));
        $this->assertSame('和歌山', $this->converter->prefectureShortNameByHiraganaName('わかやまけん'));
        $this->assertSame('鳥取', $this->converter->prefectureShortNameByHiraganaName('とっとりけん'));
        $this->assertSame('島根', $this->converter->prefectureShortNameByHiraganaName('しまねけん'));
        $this->assertSame('岡山', $this->converter->prefectureShortNameByHiraganaName('おかやまけん'));
        $this->assertSame('広島', $this->converter->prefectureShortNameByHiraganaName('ひろしまけん'));
        $this->assertSame('山口', $this->converter->prefectureShortNameByHiraganaName('やまぐちけん'));
        $this->assertSame('徳島', $this->converter->prefectureShortNameByHiraganaName('とくしまけん'));
        $this->assertSame('香川', $this->converter->prefectureShortNameByHiraganaName('かがわけん'));
        $this->assertSame('愛媛', $this->converter->prefectureShortNameByHiraganaName('えひめけん'));
        $this->assertSame('高知', $this->converter->prefectureShortNameByHiraganaName('こうちけん'));
        $this->assertSame('福岡', $this->converter->prefectureShortNameByHiraganaName('ふくおかけん'));
        $this->assertSame('佐賀', $this->converter->prefectureShortNameByHiraganaName('さがけん'));
        $this->assertSame('長崎', $this->converter->prefectureShortNameByHiraganaName('ながさきけん'));
        $this->assertSame('熊本', $this->converter->prefectureShortNameByHiraganaName('くまもとけん'));
        $this->assertSame('大分', $this->converter->prefectureShortNameByHiraganaName('おおいたけん'));
        $this->assertSame('宮崎', $this->converter->prefectureShortNameByHiraganaName('みやざきけん'));
        $this->assertSame('鹿児島', $this->converter->prefectureShortNameByHiraganaName('かごしまけん'));
        $this->assertSame('沖縄', $this->converter->prefectureShortNameByHiraganaName('おきなわけん'));
        $this->assertNull($this->converter->prefectureShortNameByHiraganaName('きょうてい'));
        $this->assertNull($this->converter->prefectureShortNameByHiraganaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureShortNameByKatakanaName(): void
    {
        $this->assertSame('北海道', $this->converter->prefectureShortNameByKatakanaName('ホッカイドウ'));
        $this->assertSame('青森', $this->converter->prefectureShortNameByKatakanaName('アオモリケン'));
        $this->assertSame('岩手', $this->converter->prefectureShortNameByKatakanaName('イワテケン'));
        $this->assertSame('宮城', $this->converter->prefectureShortNameByKatakanaName('ミヤギケン'));
        $this->assertSame('秋田', $this->converter->prefectureShortNameByKatakanaName('アキタケン'));
        $this->assertSame('山形', $this->converter->prefectureShortNameByKatakanaName('ヤマガタケン'));
        $this->assertSame('福島', $this->converter->prefectureShortNameByKatakanaName('フクシマケン'));
        $this->assertSame('茨城', $this->converter->prefectureShortNameByKatakanaName('イバラキケン'));
        $this->assertSame('栃木', $this->converter->prefectureShortNameByKatakanaName('トチギケン'));
        $this->assertSame('群馬', $this->converter->prefectureShortNameByKatakanaName('グンマケン'));
        $this->assertSame('埼玉', $this->converter->prefectureShortNameByKatakanaName('サイタマケン'));
        $this->assertSame('千葉', $this->converter->prefectureShortNameByKatakanaName('チバケン'));
        $this->assertSame('東京', $this->converter->prefectureShortNameByKatakanaName('トウキョウト'));
        $this->assertSame('神奈川', $this->converter->prefectureShortNameByKatakanaName('カナガワケン'));
        $this->assertSame('新潟', $this->converter->prefectureShortNameByKatakanaName('ニイガタケン'));
        $this->assertSame('富山', $this->converter->prefectureShortNameByKatakanaName('トヤマケン'));
        $this->assertSame('石川', $this->converter->prefectureShortNameByKatakanaName('イシカワケン'));
        $this->assertSame('福井', $this->converter->prefectureShortNameByKatakanaName('フクイケン'));
        $this->assertSame('山梨', $this->converter->prefectureShortNameByKatakanaName('ヤマナシケン'));
        $this->assertSame('長野', $this->converter->prefectureShortNameByKatakanaName('ナガノケン'));
        $this->assertSame('岐阜', $this->converter->prefectureShortNameByKatakanaName('ギフケン'));
        $this->assertSame('静岡', $this->converter->prefectureShortNameByKatakanaName('シズオカケン'));
        $this->assertSame('愛知', $this->converter->prefectureShortNameByKatakanaName('アイチケン'));
        $this->assertSame('三重', $this->converter->prefectureShortNameByKatakanaName('ミエケン'));
        $this->assertSame('滋賀', $this->converter->prefectureShortNameByKatakanaName('シガケン'));
        $this->assertSame('京都', $this->converter->prefectureShortNameByKatakanaName('キョウトフ'));
        $this->assertSame('大阪', $this->converter->prefectureShortNameByKatakanaName('オオサカフ'));
        $this->assertSame('兵庫', $this->converter->prefectureShortNameByKatakanaName('ヒョウゴケン'));
        $this->assertSame('奈良', $this->converter->prefectureShortNameByKatakanaName('ナラケン'));
        $this->assertSame('和歌山', $this->converter->prefectureShortNameByKatakanaName('ワカヤマケン'));
        $this->assertSame('鳥取', $this->converter->prefectureShortNameByKatakanaName('トットリケン'));
        $this->assertSame('島根', $this->converter->prefectureShortNameByKatakanaName('シマネケン'));
        $this->assertSame('岡山', $this->converter->prefectureShortNameByKatakanaName('オカヤマケン'));
        $this->assertSame('広島', $this->converter->prefectureShortNameByKatakanaName('ヒロシマケン'));
        $this->assertSame('山口', $this->converter->prefectureShortNameByKatakanaName('ヤマグチケン'));
        $this->assertSame('徳島', $this->converter->prefectureShortNameByKatakanaName('トクシマケン'));
        $this->assertSame('香川', $this->converter->prefectureShortNameByKatakanaName('カガワケン'));
        $this->assertSame('愛媛', $this->converter->prefectureShortNameByKatakanaName('エヒメケン'));
        $this->assertSame('高知', $this->converter->prefectureShortNameByKatakanaName('コウチケン'));
        $this->assertSame('福岡', $this->converter->prefectureShortNameByKatakanaName('フクオカケン'));
        $this->assertSame('佐賀', $this->converter->prefectureShortNameByKatakanaName('サガケン'));
        $this->assertSame('長崎', $this->converter->prefectureShortNameByKatakanaName('ナガサキケン'));
        $this->assertSame('熊本', $this->converter->prefectureShortNameByKatakanaName('クマモトケン'));
        $this->assertSame('大分', $this->converter->prefectureShortNameByKatakanaName('オオイタケン'));
        $this->assertSame('宮崎', $this->converter->prefectureShortNameByKatakanaName('ミヤザキケン'));
        $this->assertSame('鹿児島', $this->converter->prefectureShortNameByKatakanaName('カゴシマケン'));
        $this->assertSame('沖縄', $this->converter->prefectureShortNameByKatakanaName('オキナワケン'));
        $this->assertNull($this->converter->prefectureShortNameByKatakanaName('キョウテイ'));
        $this->assertNull($this->converter->prefectureShortNameByKatakanaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureShortNameByEnglishName(): void
    {
        $this->assertSame('北海道', $this->converter->prefectureShortNameByEnglishName('hokkaido'));
        $this->assertSame('青森', $this->converter->prefectureShortNameByEnglishName('aomori'));
        $this->assertSame('岩手', $this->converter->prefectureShortNameByEnglishName('iwate'));
        $this->assertSame('宮城', $this->converter->prefectureShortNameByEnglishName('miyagi'));
        $this->assertSame('秋田', $this->converter->prefectureShortNameByEnglishName('akita'));
        $this->assertSame('山形', $this->converter->prefectureShortNameByEnglishName('yamagata'));
        $this->assertSame('福島', $this->converter->prefectureShortNameByEnglishName('fukushima'));
        $this->assertSame('茨城', $this->converter->prefectureShortNameByEnglishName('ibaraki'));
        $this->assertSame('栃木', $this->converter->prefectureShortNameByEnglishName('tochigi'));
        $this->assertSame('群馬', $this->converter->prefectureShortNameByEnglishName('gunma'));
        $this->assertSame('埼玉', $this->converter->prefectureShortNameByEnglishName('saitama'));
        $this->assertSame('千葉', $this->converter->prefectureShortNameByEnglishName('chiba'));
        $this->assertSame('東京', $this->converter->prefectureShortNameByEnglishName('tokyo'));
        $this->assertSame('神奈川', $this->converter->prefectureShortNameByEnglishName('kanagawa'));
        $this->assertSame('新潟', $this->converter->prefectureShortNameByEnglishName('niigata'));
        $this->assertSame('富山', $this->converter->prefectureShortNameByEnglishName('toyama'));
        $this->assertSame('石川', $this->converter->prefectureShortNameByEnglishName('ishikawa'));
        $this->assertSame('福井', $this->converter->prefectureShortNameByEnglishName('fukui'));
        $this->assertSame('山梨', $this->converter->prefectureShortNameByEnglishName('yamanashi'));
        $this->assertSame('長野', $this->converter->prefectureShortNameByEnglishName('nagano'));
        $this->assertSame('岐阜', $this->converter->prefectureShortNameByEnglishName('gifu'));
        $this->assertSame('静岡', $this->converter->prefectureShortNameByEnglishName('shizuoka'));
        $this->assertSame('愛知', $this->converter->prefectureShortNameByEnglishName('aichi'));
        $this->assertSame('三重', $this->converter->prefectureShortNameByEnglishName('mie'));
        $this->assertSame('滋賀', $this->converter->prefectureShortNameByEnglishName('shiga'));
        $this->assertSame('京都', $this->converter->prefectureShortNameByEnglishName('kyoto'));
        $this->assertSame('大阪', $this->converter->prefectureShortNameByEnglishName('osaka'));
        $this->assertSame('兵庫', $this->converter->prefectureShortNameByEnglishName('hyogo'));
        $this->assertSame('奈良', $this->converter->prefectureShortNameByEnglishName('nara'));
        $this->assertSame('和歌山', $this->converter->prefectureShortNameByEnglishName('wakayama'));
        $this->assertSame('鳥取', $this->converter->prefectureShortNameByEnglishName('tottori'));
        $this->assertSame('島根', $this->converter->prefectureShortNameByEnglishName('shimane'));
        $this->assertSame('岡山', $this->converter->prefectureShortNameByEnglishName('okayama'));
        $this->assertSame('広島', $this->converter->prefectureShortNameByEnglishName('hiroshima'));
        $this->assertSame('山口', $this->converter->prefectureShortNameByEnglishName('yamaguchi'));
        $this->assertSame('徳島', $this->converter->prefectureShortNameByEnglishName('tokushima'));
        $this->assertSame('香川', $this->converter->prefectureShortNameByEnglishName('kagawa'));
        $this->assertSame('愛媛', $this->converter->prefectureShortNameByEnglishName('ehime'));
        $this->assertSame('高知', $this->converter->prefectureShortNameByEnglishName('kochi'));
        $this->assertSame('福岡', $this->converter->prefectureShortNameByEnglishName('fukuoka'));
        $this->assertSame('佐賀', $this->converter->prefectureShortNameByEnglishName('saga'));
        $this->assertSame('長崎', $this->converter->prefectureShortNameByEnglishName('nagasaki'));
        $this->assertSame('熊本', $this->converter->prefectureShortNameByEnglishName('kumamoto'));
        $this->assertSame('大分', $this->converter->prefectureShortNameByEnglishName('oita'));
        $this->assertSame('宮崎', $this->converter->prefectureShortNameByEnglishName('miyazaki'));
        $this->assertSame('鹿児島', $this->converter->prefectureShortNameByEnglishName('kagoshima'));
        $this->assertSame('沖縄', $this->converter->prefectureShortNameByEnglishName('okinawa'));
        $this->assertNull($this->converter->prefectureShortNameByEnglishName('kyotei'));
        $this->assertNull($this->converter->prefectureShortNameByEnglishName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureHiraganaNameById(): void
    {
        $this->assertSame('ほっかいどう', $this->converter->prefectureHiraganaNameById(1));
        $this->assertSame('あおもりけん', $this->converter->prefectureHiraganaNameById(2));
        $this->assertSame('いわてけん', $this->converter->prefectureHiraganaNameById(3));
        $this->assertSame('みやぎけん', $this->converter->prefectureHiraganaNameById(4));
        $this->assertSame('あきたけん', $this->converter->prefectureHiraganaNameById(5));
        $this->assertSame('やまがたけん', $this->converter->prefectureHiraganaNameById(6));
        $this->assertSame('ふくしまけん', $this->converter->prefectureHiraganaNameById(7));
        $this->assertSame('いばらきけん', $this->converter->prefectureHiraganaNameById(8));
        $this->assertSame('とちぎけん', $this->converter->prefectureHiraganaNameById(9));
        $this->assertSame('ぐんまけん', $this->converter->prefectureHiraganaNameById(10));
        $this->assertSame('さいたまけん', $this->converter->prefectureHiraganaNameById(11));
        $this->assertSame('ちばけん', $this->converter->prefectureHiraganaNameById(12));
        $this->assertSame('とうきょうと', $this->converter->prefectureHiraganaNameById(13));
        $this->assertSame('かながわけん', $this->converter->prefectureHiraganaNameById(14));
        $this->assertSame('にいがたけん', $this->converter->prefectureHiraganaNameById(15));
        $this->assertSame('とやまけん', $this->converter->prefectureHiraganaNameById(16));
        $this->assertSame('いしかわけん', $this->converter->prefectureHiraganaNameById(17));
        $this->assertSame('ふくいけん', $this->converter->prefectureHiraganaNameById(18));
        $this->assertSame('やまなしけん', $this->converter->prefectureHiraganaNameById(19));
        $this->assertSame('ながのけん', $this->converter->prefectureHiraganaNameById(20));
        $this->assertSame('ぎふけん', $this->converter->prefectureHiraganaNameById(21));
        $this->assertSame('しずおかけん', $this->converter->prefectureHiraganaNameById(22));
        $this->assertSame('あいちけん', $this->converter->prefectureHiraganaNameById(23));
        $this->assertSame('みえけん', $this->converter->prefectureHiraganaNameById(24));
        $this->assertSame('しがけん', $this->converter->prefectureHiraganaNameById(25));
        $this->assertSame('きょうとふ', $this->converter->prefectureHiraganaNameById(26));
        $this->assertSame('おおさかふ', $this->converter->prefectureHiraganaNameById(27));
        $this->assertSame('ひょうごけん', $this->converter->prefectureHiraganaNameById(28));
        $this->assertSame('ならけん', $this->converter->prefectureHiraganaNameById(29));
        $this->assertSame('わかやまけん', $this->converter->prefectureHiraganaNameById(30));
        $this->assertSame('とっとりけん', $this->converter->prefectureHiraganaNameById(31));
        $this->assertSame('しまねけん', $this->converter->prefectureHiraganaNameById(32));
        $this->assertSame('おかやまけん', $this->converter->prefectureHiraganaNameById(33));
        $this->assertSame('ひろしまけん', $this->converter->prefectureHiraganaNameById(34));
        $this->assertSame('やまぐちけん', $this->converter->prefectureHiraganaNameById(35));
        $this->assertSame('とくしまけん', $this->converter->prefectureHiraganaNameById(36));
        $this->assertSame('かがわけん', $this->converter->prefectureHiraganaNameById(37));
        $this->assertSame('えひめけん', $this->converter->prefectureHiraganaNameById(38));
        $this->assertSame('こうちけん', $this->converter->prefectureHiraganaNameById(39));
        $this->assertSame('ふくおかけん', $this->converter->prefectureHiraganaNameById(40));
        $this->assertSame('さがけん', $this->converter->prefectureHiraganaNameById(41));
        $this->assertSame('ながさきけん', $this->converter->prefectureHiraganaNameById(42));
        $this->assertSame('くまもとけん', $this->converter->prefectureHiraganaNameById(43));
        $this->assertSame('おおいたけん', $this->converter->prefectureHiraganaNameById(44));
        $this->assertSame('みやざきけん', $this->converter->prefectureHiraganaNameById(45));
        $this->assertSame('かごしまけん', $this->converter->prefectureHiraganaNameById(46));
        $this->assertSame('おきなわけん', $this->converter->prefectureHiraganaNameById(47));
        $this->assertNull($this->converter->prefectureNameById(48));
        $this->assertNull($this->converter->prefectureNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureHiraganaNameByName(): void
    {
        $this->assertSame('ほっかいどう', $this->converter->prefectureHiraganaNameByName('北海道'));
        $this->assertSame('あおもりけん', $this->converter->prefectureHiraganaNameByName('青森県'));
        $this->assertSame('いわてけん', $this->converter->prefectureHiraganaNameByName('岩手県'));
        $this->assertSame('みやぎけん', $this->converter->prefectureHiraganaNameByName('宮城県'));
        $this->assertSame('あきたけん', $this->converter->prefectureHiraganaNameByName('秋田県'));
        $this->assertSame('やまがたけん', $this->converter->prefectureHiraganaNameByName('山形県'));
        $this->assertSame('ふくしまけん', $this->converter->prefectureHiraganaNameByName('福島県'));
        $this->assertSame('いばらきけん', $this->converter->prefectureHiraganaNameByName('茨城県'));
        $this->assertSame('とちぎけん', $this->converter->prefectureHiraganaNameByName('栃木県'));
        $this->assertSame('ぐんまけん', $this->converter->prefectureHiraganaNameByName('群馬県'));
        $this->assertSame('さいたまけん', $this->converter->prefectureHiraganaNameByName('埼玉県'));
        $this->assertSame('ちばけん', $this->converter->prefectureHiraganaNameByName('千葉県'));
        $this->assertSame('とうきょうと', $this->converter->prefectureHiraganaNameByName('東京都'));
        $this->assertSame('かながわけん', $this->converter->prefectureHiraganaNameByName('神奈川県'));
        $this->assertSame('にいがたけん', $this->converter->prefectureHiraganaNameByName('新潟県'));
        $this->assertSame('とやまけん', $this->converter->prefectureHiraganaNameByName('富山県'));
        $this->assertSame('いしかわけん', $this->converter->prefectureHiraganaNameByName('石川県'));
        $this->assertSame('ふくいけん', $this->converter->prefectureHiraganaNameByName('福井県'));
        $this->assertSame('やまなしけん', $this->converter->prefectureHiraganaNameByName('山梨県'));
        $this->assertSame('ながのけん', $this->converter->prefectureHiraganaNameByName('長野県'));
        $this->assertSame('ぎふけん', $this->converter->prefectureHiraganaNameByName('岐阜県'));
        $this->assertSame('しずおかけん', $this->converter->prefectureHiraganaNameByName('静岡県'));
        $this->assertSame('あいちけん', $this->converter->prefectureHiraganaNameByName('愛知県'));
        $this->assertSame('みえけん', $this->converter->prefectureHiraganaNameByName('三重県'));
        $this->assertSame('しがけん', $this->converter->prefectureHiraganaNameByName('滋賀県'));
        $this->assertSame('きょうとふ', $this->converter->prefectureHiraganaNameByName('京都府'));
        $this->assertSame('おおさかふ', $this->converter->prefectureHiraganaNameByName('大阪府'));
        $this->assertSame('ひょうごけん', $this->converter->prefectureHiraganaNameByName('兵庫県'));
        $this->assertSame('ならけん', $this->converter->prefectureHiraganaNameByName('奈良県'));
        $this->assertSame('わかやまけん', $this->converter->prefectureHiraganaNameByName('和歌山県'));
        $this->assertSame('とっとりけん', $this->converter->prefectureHiraganaNameByName('鳥取県'));
        $this->assertSame('しまねけん', $this->converter->prefectureHiraganaNameByName('島根県'));
        $this->assertSame('おかやまけん', $this->converter->prefectureHiraganaNameByName('岡山県'));
        $this->assertSame('ひろしまけん', $this->converter->prefectureHiraganaNameByName('広島県'));
        $this->assertSame('やまぐちけん', $this->converter->prefectureHiraganaNameByName('山口県'));
        $this->assertSame('とくしまけん', $this->converter->prefectureHiraganaNameByName('徳島県'));
        $this->assertSame('かがわけん', $this->converter->prefectureHiraganaNameByName('香川県'));
        $this->assertSame('えひめけん', $this->converter->prefectureHiraganaNameByName('愛媛県'));
        $this->assertSame('こうちけん', $this->converter->prefectureHiraganaNameByName('高知県'));
        $this->assertSame('ふくおかけん', $this->converter->prefectureHiraganaNameByName('福岡県'));
        $this->assertSame('さがけん', $this->converter->prefectureHiraganaNameByName('佐賀県'));
        $this->assertSame('ながさきけん', $this->converter->prefectureHiraganaNameByName('長崎県'));
        $this->assertSame('くまもとけん', $this->converter->prefectureHiraganaNameByName('熊本県'));
        $this->assertSame('おおいたけん', $this->converter->prefectureHiraganaNameByName('大分県'));
        $this->assertSame('みやざきけん', $this->converter->prefectureHiraganaNameByName('宮崎県'));
        $this->assertSame('かごしまけん', $this->converter->prefectureHiraganaNameByName('鹿児島県'));
        $this->assertSame('おきなわけん', $this->converter->prefectureHiraganaNameByName('沖縄県'));
        $this->assertNull($this->converter->prefectureHiraganaNameByName('競艇'));
        $this->assertNull($this->converter->prefectureHiraganaNameByName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureHiraganaNameByShortName(): void
    {
        $this->assertSame('ほっかいどう', $this->converter->prefectureHiraganaNameByShortName('北海道'));
        $this->assertSame('あおもりけん', $this->converter->prefectureHiraganaNameByShortName('青森'));
        $this->assertSame('いわてけん', $this->converter->prefectureHiraganaNameByShortName('岩手'));
        $this->assertSame('みやぎけん', $this->converter->prefectureHiraganaNameByShortName('宮城'));
        $this->assertSame('あきたけん', $this->converter->prefectureHiraganaNameByShortName('秋田'));
        $this->assertSame('やまがたけん', $this->converter->prefectureHiraganaNameByShortName('山形'));
        $this->assertSame('ふくしまけん', $this->converter->prefectureHiraganaNameByShortName('福島'));
        $this->assertSame('いばらきけん', $this->converter->prefectureHiraganaNameByShortName('茨城'));
        $this->assertSame('とちぎけん', $this->converter->prefectureHiraganaNameByShortName('栃木'));
        $this->assertSame('ぐんまけん', $this->converter->prefectureHiraganaNameByShortName('群馬'));
        $this->assertSame('さいたまけん', $this->converter->prefectureHiraganaNameByShortName('埼玉'));
        $this->assertSame('ちばけん', $this->converter->prefectureHiraganaNameByShortName('千葉'));
        $this->assertSame('とうきょうと', $this->converter->prefectureHiraganaNameByShortName('東京'));
        $this->assertSame('かながわけん', $this->converter->prefectureHiraganaNameByShortName('神奈川'));
        $this->assertSame('にいがたけん', $this->converter->prefectureHiraganaNameByShortName('新潟'));
        $this->assertSame('とやまけん', $this->converter->prefectureHiraganaNameByShortName('富山'));
        $this->assertSame('いしかわけん', $this->converter->prefectureHiraganaNameByShortName('石川'));
        $this->assertSame('ふくいけん', $this->converter->prefectureHiraganaNameByShortName('福井'));
        $this->assertSame('やまなしけん', $this->converter->prefectureHiraganaNameByShortName('山梨'));
        $this->assertSame('ながのけん', $this->converter->prefectureHiraganaNameByShortName('長野'));
        $this->assertSame('ぎふけん', $this->converter->prefectureHiraganaNameByShortName('岐阜'));
        $this->assertSame('しずおかけん', $this->converter->prefectureHiraganaNameByShortName('静岡'));
        $this->assertSame('あいちけん', $this->converter->prefectureHiraganaNameByShortName('愛知'));
        $this->assertSame('みえけん', $this->converter->prefectureHiraganaNameByShortName('三重'));
        $this->assertSame('しがけん', $this->converter->prefectureHiraganaNameByShortName('滋賀'));
        $this->assertSame('きょうとふ', $this->converter->prefectureHiraganaNameByShortName('京都'));
        $this->assertSame('おおさかふ', $this->converter->prefectureHiraganaNameByShortName('大阪'));
        $this->assertSame('ひょうごけん', $this->converter->prefectureHiraganaNameByShortName('兵庫'));
        $this->assertSame('ならけん', $this->converter->prefectureHiraganaNameByShortName('奈良'));
        $this->assertSame('わかやまけん', $this->converter->prefectureHiraganaNameByShortName('和歌山'));
        $this->assertSame('とっとりけん', $this->converter->prefectureHiraganaNameByShortName('鳥取'));
        $this->assertSame('しまねけん', $this->converter->prefectureHiraganaNameByShortName('島根'));
        $this->assertSame('おかやまけん', $this->converter->prefectureHiraganaNameByShortName('岡山'));
        $this->assertSame('ひろしまけん', $this->converter->prefectureHiraganaNameByShortName('広島'));
        $this->assertSame('やまぐちけん', $this->converter->prefectureHiraganaNameByShortName('山口'));
        $this->assertSame('とくしまけん', $this->converter->prefectureHiraganaNameByShortName('徳島'));
        $this->assertSame('かがわけん', $this->converter->prefectureHiraganaNameByShortName('香川'));
        $this->assertSame('えひめけん', $this->converter->prefectureHiraganaNameByShortName('愛媛'));
        $this->assertSame('こうちけん', $this->converter->prefectureHiraganaNameByShortName('高知'));
        $this->assertSame('ふくおかけん', $this->converter->prefectureHiraganaNameByShortName('福岡'));
        $this->assertSame('さがけん', $this->converter->prefectureHiraganaNameByShortName('佐賀'));
        $this->assertSame('ながさきけん', $this->converter->prefectureHiraganaNameByShortName('長崎'));
        $this->assertSame('くまもとけん', $this->converter->prefectureHiraganaNameByShortName('熊本'));
        $this->assertSame('おおいたけん', $this->converter->prefectureHiraganaNameByShortName('大分'));
        $this->assertSame('みやざきけん', $this->converter->prefectureHiraganaNameByShortName('宮崎'));
        $this->assertSame('かごしまけん', $this->converter->prefectureHiraganaNameByShortName('鹿児島'));
        $this->assertSame('おきなわけん', $this->converter->prefectureHiraganaNameByShortName('沖縄'));
        $this->assertNull($this->converter->prefectureHiraganaNameByShortName('競艇'));
        $this->assertNull($this->converter->prefectureHiraganaNameByShortName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureHiraganaNameByKatakanaName(): void
    {
        $this->assertSame('ほっかいどう', $this->converter->prefectureHiraganaNameByKatakanaName('ホッカイドウ'));
        $this->assertSame('あおもりけん', $this->converter->prefectureHiraganaNameByKatakanaName('アオモリケン'));
        $this->assertSame('いわてけん', $this->converter->prefectureHiraganaNameByKatakanaName('イワテケン'));
        $this->assertSame('みやぎけん', $this->converter->prefectureHiraganaNameByKatakanaName('ミヤギケン'));
        $this->assertSame('あきたけん', $this->converter->prefectureHiraganaNameByKatakanaName('アキタケン'));
        $this->assertSame('やまがたけん', $this->converter->prefectureHiraganaNameByKatakanaName('ヤマガタケン'));
        $this->assertSame('ふくしまけん', $this->converter->prefectureHiraganaNameByKatakanaName('フクシマケン'));
        $this->assertSame('いばらきけん', $this->converter->prefectureHiraganaNameByKatakanaName('イバラキケン'));
        $this->assertSame('とちぎけん', $this->converter->prefectureHiraganaNameByKatakanaName('トチギケン'));
        $this->assertSame('ぐんまけん', $this->converter->prefectureHiraganaNameByKatakanaName('グンマケン'));
        $this->assertSame('さいたまけん', $this->converter->prefectureHiraganaNameByKatakanaName('サイタマケン'));
        $this->assertSame('ちばけん', $this->converter->prefectureHiraganaNameByKatakanaName('チバケン'));
        $this->assertSame('とうきょうと', $this->converter->prefectureHiraganaNameByKatakanaName('トウキョウト'));
        $this->assertSame('かながわけん', $this->converter->prefectureHiraganaNameByKatakanaName('カナガワケン'));
        $this->assertSame('にいがたけん', $this->converter->prefectureHiraganaNameByKatakanaName('ニイガタケン'));
        $this->assertSame('とやまけん', $this->converter->prefectureHiraganaNameByKatakanaName('トヤマケン'));
        $this->assertSame('いしかわけん', $this->converter->prefectureHiraganaNameByKatakanaName('イシカワケン'));
        $this->assertSame('ふくいけん', $this->converter->prefectureHiraganaNameByKatakanaName('フクイケン'));
        $this->assertSame('やまなしけん', $this->converter->prefectureHiraganaNameByKatakanaName('ヤマナシケン'));
        $this->assertSame('ながのけん', $this->converter->prefectureHiraganaNameByKatakanaName('ナガノケン'));
        $this->assertSame('ぎふけん', $this->converter->prefectureHiraganaNameByKatakanaName('ギフケン'));
        $this->assertSame('しずおかけん', $this->converter->prefectureHiraganaNameByKatakanaName('シズオカケン'));
        $this->assertSame('あいちけん', $this->converter->prefectureHiraganaNameByKatakanaName('アイチケン'));
        $this->assertSame('みえけん', $this->converter->prefectureHiraganaNameByKatakanaName('ミエケン'));
        $this->assertSame('しがけん', $this->converter->prefectureHiraganaNameByKatakanaName('シガケン'));
        $this->assertSame('きょうとふ', $this->converter->prefectureHiraganaNameByKatakanaName('キョウトフ'));
        $this->assertSame('おおさかふ', $this->converter->prefectureHiraganaNameByKatakanaName('オオサカフ'));
        $this->assertSame('ひょうごけん', $this->converter->prefectureHiraganaNameByKatakanaName('ヒョウゴケン'));
        $this->assertSame('ならけん', $this->converter->prefectureHiraganaNameByKatakanaName('ナラケン'));
        $this->assertSame('わかやまけん', $this->converter->prefectureHiraganaNameByKatakanaName('ワカヤマケン'));
        $this->assertSame('とっとりけん', $this->converter->prefectureHiraganaNameByKatakanaName('トットリケン'));
        $this->assertSame('しまねけん', $this->converter->prefectureHiraganaNameByKatakanaName('シマネケン'));
        $this->assertSame('おかやまけん', $this->converter->prefectureHiraganaNameByKatakanaName('オカヤマケン'));
        $this->assertSame('ひろしまけん', $this->converter->prefectureHiraganaNameByKatakanaName('ヒロシマケン'));
        $this->assertSame('やまぐちけん', $this->converter->prefectureHiraganaNameByKatakanaName('ヤマグチケン'));
        $this->assertSame('とくしまけん', $this->converter->prefectureHiraganaNameByKatakanaName('トクシマケン'));
        $this->assertSame('かがわけん', $this->converter->prefectureHiraganaNameByKatakanaName('カガワケン'));
        $this->assertSame('えひめけん', $this->converter->prefectureHiraganaNameByKatakanaName('エヒメケン'));
        $this->assertSame('こうちけん', $this->converter->prefectureHiraganaNameByKatakanaName('コウチケン'));
        $this->assertSame('ふくおかけん', $this->converter->prefectureHiraganaNameByKatakanaName('フクオカケン'));
        $this->assertSame('さがけん', $this->converter->prefectureHiraganaNameByKatakanaName('サガケン'));
        $this->assertSame('ながさきけん', $this->converter->prefectureHiraganaNameByKatakanaName('ナガサキケン'));
        $this->assertSame('くまもとけん', $this->converter->prefectureHiraganaNameByKatakanaName('クマモトケン'));
        $this->assertSame('おおいたけん', $this->converter->prefectureHiraganaNameByKatakanaName('オオイタケン'));
        $this->assertSame('みやざきけん', $this->converter->prefectureHiraganaNameByKatakanaName('ミヤザキケン'));
        $this->assertSame('かごしまけん', $this->converter->prefectureHiraganaNameByKatakanaName('カゴシマケン'));
        $this->assertSame('おきなわけん', $this->converter->prefectureHiraganaNameByKatakanaName('オキナワケン'));
        $this->assertNull($this->converter->prefectureHiraganaNameByKatakanaName('キョウテイ'));
        $this->assertNull($this->converter->prefectureHiraganaNameByKatakanaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureHiraganaNameByEnglishName(): void
    {
        $this->assertSame('ほっかいどう', $this->converter->prefectureHiraganaNameByEnglishName('hokkaido'));
        $this->assertSame('あおもりけん', $this->converter->prefectureHiraganaNameByEnglishName('aomori'));
        $this->assertSame('いわてけん', $this->converter->prefectureHiraganaNameByEnglishName('iwate'));
        $this->assertSame('みやぎけん', $this->converter->prefectureHiraganaNameByEnglishName('miyagi'));
        $this->assertSame('あきたけん', $this->converter->prefectureHiraganaNameByEnglishName('akita'));
        $this->assertSame('やまがたけん', $this->converter->prefectureHiraganaNameByEnglishName('yamagata'));
        $this->assertSame('ふくしまけん', $this->converter->prefectureHiraganaNameByEnglishName('fukushima'));
        $this->assertSame('いばらきけん', $this->converter->prefectureHiraganaNameByEnglishName('ibaraki'));
        $this->assertSame('とちぎけん', $this->converter->prefectureHiraganaNameByEnglishName('tochigi'));
        $this->assertSame('ぐんまけん', $this->converter->prefectureHiraganaNameByEnglishName('gunma'));
        $this->assertSame('さいたまけん', $this->converter->prefectureHiraganaNameByEnglishName('saitama'));
        $this->assertSame('ちばけん', $this->converter->prefectureHiraganaNameByEnglishName('chiba'));
        $this->assertSame('とうきょうと', $this->converter->prefectureHiraganaNameByEnglishName('tokyo'));
        $this->assertSame('かながわけん', $this->converter->prefectureHiraganaNameByEnglishName('kanagawa'));
        $this->assertSame('にいがたけん', $this->converter->prefectureHiraganaNameByEnglishName('niigata'));
        $this->assertSame('とやまけん', $this->converter->prefectureHiraganaNameByEnglishName('toyama'));
        $this->assertSame('いしかわけん', $this->converter->prefectureHiraganaNameByEnglishName('ishikawa'));
        $this->assertSame('ふくいけん', $this->converter->prefectureHiraganaNameByEnglishName('fukui'));
        $this->assertSame('やまなしけん', $this->converter->prefectureHiraganaNameByEnglishName('yamanashi'));
        $this->assertSame('ながのけん', $this->converter->prefectureHiraganaNameByEnglishName('nagano'));
        $this->assertSame('ぎふけん', $this->converter->prefectureHiraganaNameByEnglishName('gifu'));
        $this->assertSame('しずおかけん', $this->converter->prefectureHiraganaNameByEnglishName('shizuoka'));
        $this->assertSame('あいちけん', $this->converter->prefectureHiraganaNameByEnglishName('aichi'));
        $this->assertSame('みえけん', $this->converter->prefectureHiraganaNameByEnglishName('mie'));
        $this->assertSame('しがけん', $this->converter->prefectureHiraganaNameByEnglishName('shiga'));
        $this->assertSame('きょうとふ', $this->converter->prefectureHiraganaNameByEnglishName('kyoto'));
        $this->assertSame('おおさかふ', $this->converter->prefectureHiraganaNameByEnglishName('osaka'));
        $this->assertSame('ひょうごけん', $this->converter->prefectureHiraganaNameByEnglishName('hyogo'));
        $this->assertSame('ならけん', $this->converter->prefectureHiraganaNameByEnglishName('nara'));
        $this->assertSame('わかやまけん', $this->converter->prefectureHiraganaNameByEnglishName('wakayama'));
        $this->assertSame('とっとりけん', $this->converter->prefectureHiraganaNameByEnglishName('tottori'));
        $this->assertSame('しまねけん', $this->converter->prefectureHiraganaNameByEnglishName('shimane'));
        $this->assertSame('おかやまけん', $this->converter->prefectureHiraganaNameByEnglishName('okayama'));
        $this->assertSame('ひろしまけん', $this->converter->prefectureHiraganaNameByEnglishName('hiroshima'));
        $this->assertSame('やまぐちけん', $this->converter->prefectureHiraganaNameByEnglishName('yamaguchi'));
        $this->assertSame('とくしまけん', $this->converter->prefectureHiraganaNameByEnglishName('tokushima'));
        $this->assertSame('かがわけん', $this->converter->prefectureHiraganaNameByEnglishName('kagawa'));
        $this->assertSame('えひめけん', $this->converter->prefectureHiraganaNameByEnglishName('ehime'));
        $this->assertSame('こうちけん', $this->converter->prefectureHiraganaNameByEnglishName('kochi'));
        $this->assertSame('ふくおかけん', $this->converter->prefectureHiraganaNameByEnglishName('fukuoka'));
        $this->assertSame('さがけん', $this->converter->prefectureHiraganaNameByEnglishName('saga'));
        $this->assertSame('ながさきけん', $this->converter->prefectureHiraganaNameByEnglishName('nagasaki'));
        $this->assertSame('くまもとけん', $this->converter->prefectureHiraganaNameByEnglishName('kumamoto'));
        $this->assertSame('おおいたけん', $this->converter->prefectureHiraganaNameByEnglishName('oita'));
        $this->assertSame('みやざきけん', $this->converter->prefectureHiraganaNameByEnglishName('miyazaki'));
        $this->assertSame('かごしまけん', $this->converter->prefectureHiraganaNameByEnglishName('kagoshima'));
        $this->assertSame('おきなわけん', $this->converter->prefectureHiraganaNameByEnglishName('okinawa'));
        $this->assertNull($this->converter->prefectureHiraganaNameByEnglishName('kyotei'));
        $this->assertNull($this->converter->prefectureHiraganaNameByEnglishName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureKatakanaNameById(): void
    {
        $this->assertSame('ホッカイドウ', $this->converter->prefectureKatakanaNameById(1));
        $this->assertSame('アオモリケン', $this->converter->prefectureKatakanaNameById(2));
        $this->assertSame('イワテケン', $this->converter->prefectureKatakanaNameById(3));
        $this->assertSame('ミヤギケン', $this->converter->prefectureKatakanaNameById(4));
        $this->assertSame('アキタケン', $this->converter->prefectureKatakanaNameById(5));
        $this->assertSame('ヤマガタケン', $this->converter->prefectureKatakanaNameById(6));
        $this->assertSame('フクシマケン', $this->converter->prefectureKatakanaNameById(7));
        $this->assertSame('イバラキケン', $this->converter->prefectureKatakanaNameById(8));
        $this->assertSame('トチギケン', $this->converter->prefectureKatakanaNameById(9));
        $this->assertSame('グンマケン', $this->converter->prefectureKatakanaNameById(10));
        $this->assertSame('サイタマケン', $this->converter->prefectureKatakanaNameById(11));
        $this->assertSame('チバケン', $this->converter->prefectureKatakanaNameById(12));
        $this->assertSame('トウキョウト', $this->converter->prefectureKatakanaNameById(13));
        $this->assertSame('カナガワケン', $this->converter->prefectureKatakanaNameById(14));
        $this->assertSame('ニイガタケン', $this->converter->prefectureKatakanaNameById(15));
        $this->assertSame('トヤマケン', $this->converter->prefectureKatakanaNameById(16));
        $this->assertSame('イシカワケン', $this->converter->prefectureKatakanaNameById(17));
        $this->assertSame('フクイケン', $this->converter->prefectureKatakanaNameById(18));
        $this->assertSame('ヤマナシケン', $this->converter->prefectureKatakanaNameById(19));
        $this->assertSame('ナガノケン', $this->converter->prefectureKatakanaNameById(20));
        $this->assertSame('ギフケン', $this->converter->prefectureKatakanaNameById(21));
        $this->assertSame('シズオカケン', $this->converter->prefectureKatakanaNameById(22));
        $this->assertSame('アイチケン', $this->converter->prefectureKatakanaNameById(23));
        $this->assertSame('ミエケン', $this->converter->prefectureKatakanaNameById(24));
        $this->assertSame('シガケン', $this->converter->prefectureKatakanaNameById(25));
        $this->assertSame('キョウトフ', $this->converter->prefectureKatakanaNameById(26));
        $this->assertSame('オオサカフ', $this->converter->prefectureKatakanaNameById(27));
        $this->assertSame('ヒョウゴケン', $this->converter->prefectureKatakanaNameById(28));
        $this->assertSame('ナラケン', $this->converter->prefectureKatakanaNameById(29));
        $this->assertSame('ワカヤマケン', $this->converter->prefectureKatakanaNameById(30));
        $this->assertSame('トットリケン', $this->converter->prefectureKatakanaNameById(31));
        $this->assertSame('シマネケン', $this->converter->prefectureKatakanaNameById(32));
        $this->assertSame('オカヤマケン', $this->converter->prefectureKatakanaNameById(33));
        $this->assertSame('ヒロシマケン', $this->converter->prefectureKatakanaNameById(34));
        $this->assertSame('ヤマグチケン', $this->converter->prefectureKatakanaNameById(35));
        $this->assertSame('トクシマケン', $this->converter->prefectureKatakanaNameById(36));
        $this->assertSame('カガワケン', $this->converter->prefectureKatakanaNameById(37));
        $this->assertSame('エヒメケン', $this->converter->prefectureKatakanaNameById(38));
        $this->assertSame('コウチケン', $this->converter->prefectureKatakanaNameById(39));
        $this->assertSame('フクオカケン', $this->converter->prefectureKatakanaNameById(40));
        $this->assertSame('サガケン', $this->converter->prefectureKatakanaNameById(41));
        $this->assertSame('ナガサキケン', $this->converter->prefectureKatakanaNameById(42));
        $this->assertSame('クマモトケン', $this->converter->prefectureKatakanaNameById(43));
        $this->assertSame('オオイタケン', $this->converter->prefectureKatakanaNameById(44));
        $this->assertSame('ミヤザキケン', $this->converter->prefectureKatakanaNameById(45));
        $this->assertSame('カゴシマケン', $this->converter->prefectureKatakanaNameById(46));
        $this->assertSame('オキナワケン', $this->converter->prefectureKatakanaNameById(47));
        $this->assertNull($this->converter->prefectureKatakanaNameById(48));
        $this->assertNull($this->converter->prefectureKatakanaNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureKatakanaNameByName(): void
    {
        $this->assertSame('ホッカイドウ', $this->converter->prefectureKatakanaNameByName('北海道'));
        $this->assertSame('アオモリケン', $this->converter->prefectureKatakanaNameByName('青森県'));
        $this->assertSame('イワテケン', $this->converter->prefectureKatakanaNameByName('岩手県'));
        $this->assertSame('ミヤギケン', $this->converter->prefectureKatakanaNameByName('宮城県'));
        $this->assertSame('アキタケン', $this->converter->prefectureKatakanaNameByName('秋田県'));
        $this->assertSame('ヤマガタケン', $this->converter->prefectureKatakanaNameByName('山形県'));
        $this->assertSame('フクシマケン', $this->converter->prefectureKatakanaNameByName('福島県'));
        $this->assertSame('イバラキケン', $this->converter->prefectureKatakanaNameByName('茨城県'));
        $this->assertSame('トチギケン', $this->converter->prefectureKatakanaNameByName('栃木県'));
        $this->assertSame('グンマケン', $this->converter->prefectureKatakanaNameByName('群馬県'));
        $this->assertSame('サイタマケン', $this->converter->prefectureKatakanaNameByName('埼玉県'));
        $this->assertSame('チバケン', $this->converter->prefectureKatakanaNameByName('千葉県'));
        $this->assertSame('トウキョウト', $this->converter->prefectureKatakanaNameByName('東京都'));
        $this->assertSame('カナガワケン', $this->converter->prefectureKatakanaNameByName('神奈川県'));
        $this->assertSame('ニイガタケン', $this->converter->prefectureKatakanaNameByName('新潟県'));
        $this->assertSame('トヤマケン', $this->converter->prefectureKatakanaNameByName('富山県'));
        $this->assertSame('イシカワケン', $this->converter->prefectureKatakanaNameByName('石川県'));
        $this->assertSame('フクイケン', $this->converter->prefectureKatakanaNameByName('福井県'));
        $this->assertSame('ヤマナシケン', $this->converter->prefectureKatakanaNameByName('山梨県'));
        $this->assertSame('ナガノケン', $this->converter->prefectureKatakanaNameByName('長野県'));
        $this->assertSame('ギフケン', $this->converter->prefectureKatakanaNameByName('岐阜県'));
        $this->assertSame('シズオカケン', $this->converter->prefectureKatakanaNameByName('静岡県'));
        $this->assertSame('アイチケン', $this->converter->prefectureKatakanaNameByName('愛知県'));
        $this->assertSame('ミエケン', $this->converter->prefectureKatakanaNameByName('三重県'));
        $this->assertSame('シガケン', $this->converter->prefectureKatakanaNameByName('滋賀県'));
        $this->assertSame('キョウトフ', $this->converter->prefectureKatakanaNameByName('京都府'));
        $this->assertSame('オオサカフ', $this->converter->prefectureKatakanaNameByName('大阪府'));
        $this->assertSame('ヒョウゴケン', $this->converter->prefectureKatakanaNameByName('兵庫県'));
        $this->assertSame('ナラケン', $this->converter->prefectureKatakanaNameByName('奈良県'));
        $this->assertSame('ワカヤマケン', $this->converter->prefectureKatakanaNameByName('和歌山県'));
        $this->assertSame('トットリケン', $this->converter->prefectureKatakanaNameByName('鳥取県'));
        $this->assertSame('シマネケン', $this->converter->prefectureKatakanaNameByName('島根県'));
        $this->assertSame('オカヤマケン', $this->converter->prefectureKatakanaNameByName('岡山県'));
        $this->assertSame('ヒロシマケン', $this->converter->prefectureKatakanaNameByName('広島県'));
        $this->assertSame('ヤマグチケン', $this->converter->prefectureKatakanaNameByName('山口県'));
        $this->assertSame('トクシマケン', $this->converter->prefectureKatakanaNameByName('徳島県'));
        $this->assertSame('カガワケン', $this->converter->prefectureKatakanaNameByName('香川県'));
        $this->assertSame('エヒメケン', $this->converter->prefectureKatakanaNameByName('愛媛県'));
        $this->assertSame('コウチケン', $this->converter->prefectureKatakanaNameByName('高知県'));
        $this->assertSame('フクオカケン', $this->converter->prefectureKatakanaNameByName('福岡県'));
        $this->assertSame('サガケン', $this->converter->prefectureKatakanaNameByName('佐賀県'));
        $this->assertSame('ナガサキケン', $this->converter->prefectureKatakanaNameByName('長崎県'));
        $this->assertSame('クマモトケン', $this->converter->prefectureKatakanaNameByName('熊本県'));
        $this->assertSame('オオイタケン', $this->converter->prefectureKatakanaNameByName('大分県'));
        $this->assertSame('ミヤザキケン', $this->converter->prefectureKatakanaNameByName('宮崎県'));
        $this->assertSame('カゴシマケン', $this->converter->prefectureKatakanaNameByName('鹿児島県'));
        $this->assertSame('オキナワケン', $this->converter->prefectureKatakanaNameByName('沖縄県'));
        $this->assertNull($this->converter->prefectureKatakanaNameByName('競艇'));
        $this->assertNull($this->converter->prefectureKatakanaNameByName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureKatakanaNameByShortName(): void
    {
        $this->assertSame('ホッカイドウ', $this->converter->prefectureKatakanaNameByShortName('北海道'));
        $this->assertSame('アオモリケン', $this->converter->prefectureKatakanaNameByShortName('青森'));
        $this->assertSame('イワテケン', $this->converter->prefectureKatakanaNameByShortName('岩手'));
        $this->assertSame('ミヤギケン', $this->converter->prefectureKatakanaNameByShortName('宮城'));
        $this->assertSame('アキタケン', $this->converter->prefectureKatakanaNameByShortName('秋田'));
        $this->assertSame('ヤマガタケン', $this->converter->prefectureKatakanaNameByShortName('山形'));
        $this->assertSame('フクシマケン', $this->converter->prefectureKatakanaNameByShortName('福島'));
        $this->assertSame('イバラキケン', $this->converter->prefectureKatakanaNameByShortName('茨城'));
        $this->assertSame('トチギケン', $this->converter->prefectureKatakanaNameByShortName('栃木'));
        $this->assertSame('グンマケン', $this->converter->prefectureKatakanaNameByShortName('群馬'));
        $this->assertSame('サイタマケン', $this->converter->prefectureKatakanaNameByShortName('埼玉'));
        $this->assertSame('チバケン', $this->converter->prefectureKatakanaNameByShortName('千葉'));
        $this->assertSame('トウキョウト', $this->converter->prefectureKatakanaNameByShortName('東京'));
        $this->assertSame('カナガワケン', $this->converter->prefectureKatakanaNameByShortName('神奈川'));
        $this->assertSame('ニイガタケン', $this->converter->prefectureKatakanaNameByShortName('新潟'));
        $this->assertSame('トヤマケン', $this->converter->prefectureKatakanaNameByShortName('富山'));
        $this->assertSame('イシカワケン', $this->converter->prefectureKatakanaNameByShortName('石川'));
        $this->assertSame('フクイケン', $this->converter->prefectureKatakanaNameByShortName('福井'));
        $this->assertSame('ヤマナシケン', $this->converter->prefectureKatakanaNameByShortName('山梨'));
        $this->assertSame('ナガノケン', $this->converter->prefectureKatakanaNameByShortName('長野'));
        $this->assertSame('ギフケン', $this->converter->prefectureKatakanaNameByShortName('岐阜'));
        $this->assertSame('シズオカケン', $this->converter->prefectureKatakanaNameByShortName('静岡'));
        $this->assertSame('アイチケン', $this->converter->prefectureKatakanaNameByShortName('愛知'));
        $this->assertSame('ミエケン', $this->converter->prefectureKatakanaNameByShortName('三重'));
        $this->assertSame('シガケン', $this->converter->prefectureKatakanaNameByShortName('滋賀'));
        $this->assertSame('キョウトフ', $this->converter->prefectureKatakanaNameByShortName('京都'));
        $this->assertSame('オオサカフ', $this->converter->prefectureKatakanaNameByShortName('大阪'));
        $this->assertSame('ヒョウゴケン', $this->converter->prefectureKatakanaNameByShortName('兵庫'));
        $this->assertSame('ナラケン', $this->converter->prefectureKatakanaNameByShortName('奈良'));
        $this->assertSame('ワカヤマケン', $this->converter->prefectureKatakanaNameByShortName('和歌山'));
        $this->assertSame('トットリケン', $this->converter->prefectureKatakanaNameByShortName('鳥取'));
        $this->assertSame('シマネケン', $this->converter->prefectureKatakanaNameByShortName('島根'));
        $this->assertSame('オカヤマケン', $this->converter->prefectureKatakanaNameByShortName('岡山'));
        $this->assertSame('ヒロシマケン', $this->converter->prefectureKatakanaNameByShortName('広島'));
        $this->assertSame('ヤマグチケン', $this->converter->prefectureKatakanaNameByShortName('山口'));
        $this->assertSame('トクシマケン', $this->converter->prefectureKatakanaNameByShortName('徳島'));
        $this->assertSame('カガワケン', $this->converter->prefectureKatakanaNameByShortName('香川'));
        $this->assertSame('エヒメケン', $this->converter->prefectureKatakanaNameByShortName('愛媛'));
        $this->assertSame('コウチケン', $this->converter->prefectureKatakanaNameByShortName('高知'));
        $this->assertSame('フクオカケン', $this->converter->prefectureKatakanaNameByShortName('福岡'));
        $this->assertSame('サガケン', $this->converter->prefectureKatakanaNameByShortName('佐賀'));
        $this->assertSame('ナガサキケン', $this->converter->prefectureKatakanaNameByShortName('長崎'));
        $this->assertSame('クマモトケン', $this->converter->prefectureKatakanaNameByShortName('熊本'));
        $this->assertSame('オオイタケン', $this->converter->prefectureKatakanaNameByShortName('大分'));
        $this->assertSame('ミヤザキケン', $this->converter->prefectureKatakanaNameByShortName('宮崎'));
        $this->assertSame('カゴシマケン', $this->converter->prefectureKatakanaNameByShortName('鹿児島'));
        $this->assertSame('オキナワケン', $this->converter->prefectureKatakanaNameByShortName('沖縄'));
        $this->assertNull($this->converter->prefectureKatakanaNameByShortName('競艇'));
        $this->assertNull($this->converter->prefectureKatakanaNameByShortName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureKatakanaNameByHiraganaName(): void
    {
        $this->assertSame('ホッカイドウ', $this->converter->prefectureKatakanaNameByHiraganaName('ほっかいどう'));
        $this->assertSame('アオモリケン', $this->converter->prefectureKatakanaNameByHiraganaName('あおもりけん'));
        $this->assertSame('イワテケン', $this->converter->prefectureKatakanaNameByHiraganaName('いわてけん'));
        $this->assertSame('ミヤギケン', $this->converter->prefectureKatakanaNameByHiraganaName('みやぎけん'));
        $this->assertSame('アキタケン', $this->converter->prefectureKatakanaNameByHiraganaName('あきたけん'));
        $this->assertSame('ヤマガタケン', $this->converter->prefectureKatakanaNameByHiraganaName('やまがたけん'));
        $this->assertSame('フクシマケン', $this->converter->prefectureKatakanaNameByHiraganaName('ふくしまけん'));
        $this->assertSame('イバラキケン', $this->converter->prefectureKatakanaNameByHiraganaName('いばらきけん'));
        $this->assertSame('トチギケン', $this->converter->prefectureKatakanaNameByHiraganaName('とちぎけん'));
        $this->assertSame('グンマケン', $this->converter->prefectureKatakanaNameByHiraganaName('ぐんまけん'));
        $this->assertSame('サイタマケン', $this->converter->prefectureKatakanaNameByHiraganaName('さいたまけん'));
        $this->assertSame('チバケン', $this->converter->prefectureKatakanaNameByHiraganaName('ちばけん'));
        $this->assertSame('トウキョウト', $this->converter->prefectureKatakanaNameByHiraganaName('とうきょうと'));
        $this->assertSame('カナガワケン', $this->converter->prefectureKatakanaNameByHiraganaName('かながわけん'));
        $this->assertSame('ニイガタケン', $this->converter->prefectureKatakanaNameByHiraganaName('にいがたけん'));
        $this->assertSame('トヤマケン', $this->converter->prefectureKatakanaNameByHiraganaName('とやまけん'));
        $this->assertSame('イシカワケン', $this->converter->prefectureKatakanaNameByHiraganaName('いしかわけん'));
        $this->assertSame('フクイケン', $this->converter->prefectureKatakanaNameByHiraganaName('ふくいけん'));
        $this->assertSame('ヤマナシケン', $this->converter->prefectureKatakanaNameByHiraganaName('やまなしけん'));
        $this->assertSame('ナガノケン', $this->converter->prefectureKatakanaNameByHiraganaName('ながのけん'));
        $this->assertSame('ギフケン', $this->converter->prefectureKatakanaNameByHiraganaName('ぎふけん'));
        $this->assertSame('シズオカケン', $this->converter->prefectureKatakanaNameByHiraganaName('しずおかけん'));
        $this->assertSame('アイチケン', $this->converter->prefectureKatakanaNameByHiraganaName('あいちけん'));
        $this->assertSame('ミエケン', $this->converter->prefectureKatakanaNameByHiraganaName('みえけん'));
        $this->assertSame('シガケン', $this->converter->prefectureKatakanaNameByHiraganaName('しがけん'));
        $this->assertSame('キョウトフ', $this->converter->prefectureKatakanaNameByHiraganaName('きょうとふ'));
        $this->assertSame('オオサカフ', $this->converter->prefectureKatakanaNameByHiraganaName('おおさかふ'));
        $this->assertSame('ヒョウゴケン', $this->converter->prefectureKatakanaNameByHiraganaName('ひょうごけん'));
        $this->assertSame('ナラケン', $this->converter->prefectureKatakanaNameByHiraganaName('ならけん'));
        $this->assertSame('ワカヤマケン', $this->converter->prefectureKatakanaNameByHiraganaName('わかやまけん'));
        $this->assertSame('トットリケン', $this->converter->prefectureKatakanaNameByHiraganaName('とっとりけん'));
        $this->assertSame('シマネケン', $this->converter->prefectureKatakanaNameByHiraganaName('しまねけん'));
        $this->assertSame('オカヤマケン', $this->converter->prefectureKatakanaNameByHiraganaName('おかやまけん'));
        $this->assertSame('ヒロシマケン', $this->converter->prefectureKatakanaNameByHiraganaName('ひろしまけん'));
        $this->assertSame('ヤマグチケン', $this->converter->prefectureKatakanaNameByHiraganaName('やまぐちけん'));
        $this->assertSame('トクシマケン', $this->converter->prefectureKatakanaNameByHiraganaName('とくしまけん'));
        $this->assertSame('カガワケン', $this->converter->prefectureKatakanaNameByHiraganaName('かがわけん'));
        $this->assertSame('エヒメケン', $this->converter->prefectureKatakanaNameByHiraganaName('えひめけん'));
        $this->assertSame('コウチケン', $this->converter->prefectureKatakanaNameByHiraganaName('こうちけん'));
        $this->assertSame('フクオカケン', $this->converter->prefectureKatakanaNameByHiraganaName('ふくおかけん'));
        $this->assertSame('サガケン', $this->converter->prefectureKatakanaNameByHiraganaName('さがけん'));
        $this->assertSame('ナガサキケン', $this->converter->prefectureKatakanaNameByHiraganaName('ながさきけん'));
        $this->assertSame('クマモトケン', $this->converter->prefectureKatakanaNameByHiraganaName('くまもとけん'));
        $this->assertSame('オオイタケン', $this->converter->prefectureKatakanaNameByHiraganaName('おおいたけん'));
        $this->assertSame('ミヤザキケン', $this->converter->prefectureKatakanaNameByHiraganaName('みやざきけん'));
        $this->assertSame('カゴシマケン', $this->converter->prefectureKatakanaNameByHiraganaName('かごしまけん'));
        $this->assertSame('オキナワケン', $this->converter->prefectureKatakanaNameByHiraganaName('おきなわけん'));
        $this->assertNull($this->converter->prefectureKatakanaNameByHiraganaName('きょうてい'));
        $this->assertNull($this->converter->prefectureKatakanaNameByHiraganaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureKatakanaNameByEnglishName(): void
    {
        $this->assertSame('ホッカイドウ', $this->converter->prefectureKatakanaNameByEnglishName('hokkaido'));
        $this->assertSame('アオモリケン', $this->converter->prefectureKatakanaNameByEnglishName('aomori'));
        $this->assertSame('イワテケン', $this->converter->prefectureKatakanaNameByEnglishName('iwate'));
        $this->assertSame('ミヤギケン', $this->converter->prefectureKatakanaNameByEnglishName('miyagi'));
        $this->assertSame('アキタケン', $this->converter->prefectureKatakanaNameByEnglishName('akita'));
        $this->assertSame('ヤマガタケン', $this->converter->prefectureKatakanaNameByEnglishName('yamagata'));
        $this->assertSame('フクシマケン', $this->converter->prefectureKatakanaNameByEnglishName('fukushima'));
        $this->assertSame('イバラキケン', $this->converter->prefectureKatakanaNameByEnglishName('ibaraki'));
        $this->assertSame('トチギケン', $this->converter->prefectureKatakanaNameByEnglishName('tochigi'));
        $this->assertSame('グンマケン', $this->converter->prefectureKatakanaNameByEnglishName('gunma'));
        $this->assertSame('サイタマケン', $this->converter->prefectureKatakanaNameByEnglishName('saitama'));
        $this->assertSame('チバケン', $this->converter->prefectureKatakanaNameByEnglishName('chiba'));
        $this->assertSame('トウキョウト', $this->converter->prefectureKatakanaNameByEnglishName('tokyo'));
        $this->assertSame('カナガワケン', $this->converter->prefectureKatakanaNameByEnglishName('kanagawa'));
        $this->assertSame('ニイガタケン', $this->converter->prefectureKatakanaNameByEnglishName('niigata'));
        $this->assertSame('トヤマケン', $this->converter->prefectureKatakanaNameByEnglishName('toyama'));
        $this->assertSame('イシカワケン', $this->converter->prefectureKatakanaNameByEnglishName('ishikawa'));
        $this->assertSame('フクイケン', $this->converter->prefectureKatakanaNameByEnglishName('fukui'));
        $this->assertSame('ヤマナシケン', $this->converter->prefectureKatakanaNameByEnglishName('yamanashi'));
        $this->assertSame('ナガノケン', $this->converter->prefectureKatakanaNameByEnglishName('nagano'));
        $this->assertSame('ギフケン', $this->converter->prefectureKatakanaNameByEnglishName('gifu'));
        $this->assertSame('シズオカケン', $this->converter->prefectureKatakanaNameByEnglishName('shizuoka'));
        $this->assertSame('アイチケン', $this->converter->prefectureKatakanaNameByEnglishName('aichi'));
        $this->assertSame('ミエケン', $this->converter->prefectureKatakanaNameByEnglishName('mie'));
        $this->assertSame('シガケン', $this->converter->prefectureKatakanaNameByEnglishName('shiga'));
        $this->assertSame('キョウトフ', $this->converter->prefectureKatakanaNameByEnglishName('kyoto'));
        $this->assertSame('オオサカフ', $this->converter->prefectureKatakanaNameByEnglishName('osaka'));
        $this->assertSame('ヒョウゴケン', $this->converter->prefectureKatakanaNameByEnglishName('hyogo'));
        $this->assertSame('ナラケン', $this->converter->prefectureKatakanaNameByEnglishName('nara'));
        $this->assertSame('ワカヤマケン', $this->converter->prefectureKatakanaNameByEnglishName('wakayama'));
        $this->assertSame('トットリケン', $this->converter->prefectureKatakanaNameByEnglishName('tottori'));
        $this->assertSame('シマネケン', $this->converter->prefectureKatakanaNameByEnglishName('shimane'));
        $this->assertSame('オカヤマケン', $this->converter->prefectureKatakanaNameByEnglishName('okayama'));
        $this->assertSame('ヒロシマケン', $this->converter->prefectureKatakanaNameByEnglishName('hiroshima'));
        $this->assertSame('ヤマグチケン', $this->converter->prefectureKatakanaNameByEnglishName('yamaguchi'));
        $this->assertSame('トクシマケン', $this->converter->prefectureKatakanaNameByEnglishName('tokushima'));
        $this->assertSame('カガワケン', $this->converter->prefectureKatakanaNameByEnglishName('kagawa'));
        $this->assertSame('エヒメケン', $this->converter->prefectureKatakanaNameByEnglishName('ehime'));
        $this->assertSame('コウチケン', $this->converter->prefectureKatakanaNameByEnglishName('kochi'));
        $this->assertSame('フクオカケン', $this->converter->prefectureKatakanaNameByEnglishName('fukuoka'));
        $this->assertSame('サガケン', $this->converter->prefectureKatakanaNameByEnglishName('saga'));
        $this->assertSame('ナガサキケン', $this->converter->prefectureKatakanaNameByEnglishName('nagasaki'));
        $this->assertSame('クマモトケン', $this->converter->prefectureKatakanaNameByEnglishName('kumamoto'));
        $this->assertSame('オオイタケン', $this->converter->prefectureKatakanaNameByEnglishName('oita'));
        $this->assertSame('ミヤザキケン', $this->converter->prefectureKatakanaNameByEnglishName('miyazaki'));
        $this->assertSame('カゴシマケン', $this->converter->prefectureKatakanaNameByEnglishName('kagoshima'));
        $this->assertSame('オキナワケン', $this->converter->prefectureKatakanaNameByEnglishName('okinawa'));
        $this->assertNull($this->converter->prefectureKatakanaNameByEnglishName('kyotei'));
        $this->assertNull($this->converter->prefectureKatakanaNameByEnglishName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureEnglishNameById(): void
    {
        $this->assertSame('hokkaido', $this->converter->prefectureEnglishNameById(1));
        $this->assertSame('aomori', $this->converter->prefectureEnglishNameById(2));
        $this->assertSame('iwate', $this->converter->prefectureEnglishNameById(3));
        $this->assertSame('miyagi', $this->converter->prefectureEnglishNameById(4));
        $this->assertSame('akita', $this->converter->prefectureEnglishNameById(5));
        $this->assertSame('yamagata', $this->converter->prefectureEnglishNameById(6));
        $this->assertSame('fukushima', $this->converter->prefectureEnglishNameById(7));
        $this->assertSame('ibaraki', $this->converter->prefectureEnglishNameById(8));
        $this->assertSame('tochigi', $this->converter->prefectureEnglishNameById(9));
        $this->assertSame('gunma', $this->converter->prefectureEnglishNameById(10));
        $this->assertSame('saitama', $this->converter->prefectureEnglishNameById(11));
        $this->assertSame('chiba', $this->converter->prefectureEnglishNameById(12));
        $this->assertSame('tokyo', $this->converter->prefectureEnglishNameById(13));
        $this->assertSame('kanagawa', $this->converter->prefectureEnglishNameById(14));
        $this->assertSame('niigata', $this->converter->prefectureEnglishNameById(15));
        $this->assertSame('toyama', $this->converter->prefectureEnglishNameById(16));
        $this->assertSame('ishikawa', $this->converter->prefectureEnglishNameById(17));
        $this->assertSame('fukui', $this->converter->prefectureEnglishNameById(18));
        $this->assertSame('yamanashi', $this->converter->prefectureEnglishNameById(19));
        $this->assertSame('nagano', $this->converter->prefectureEnglishNameById(20));
        $this->assertSame('gifu', $this->converter->prefectureEnglishNameById(21));
        $this->assertSame('shizuoka', $this->converter->prefectureEnglishNameById(22));
        $this->assertSame('aichi', $this->converter->prefectureEnglishNameById(23));
        $this->assertSame('mie', $this->converter->prefectureEnglishNameById(24));
        $this->assertSame('shiga', $this->converter->prefectureEnglishNameById(25));
        $this->assertSame('kyoto', $this->converter->prefectureEnglishNameById(26));
        $this->assertSame('osaka', $this->converter->prefectureEnglishNameById(27));
        $this->assertSame('hyogo', $this->converter->prefectureEnglishNameById(28));
        $this->assertSame('nara', $this->converter->prefectureEnglishNameById(29));
        $this->assertSame('wakayama', $this->converter->prefectureEnglishNameById(30));
        $this->assertSame('tottori', $this->converter->prefectureEnglishNameById(31));
        $this->assertSame('shimane', $this->converter->prefectureEnglishNameById(32));
        $this->assertSame('okayama', $this->converter->prefectureEnglishNameById(33));
        $this->assertSame('hiroshima', $this->converter->prefectureEnglishNameById(34));
        $this->assertSame('yamaguchi', $this->converter->prefectureEnglishNameById(35));
        $this->assertSame('tokushima', $this->converter->prefectureEnglishNameById(36));
        $this->assertSame('kagawa', $this->converter->prefectureEnglishNameById(37));
        $this->assertSame('ehime', $this->converter->prefectureEnglishNameById(38));
        $this->assertSame('kochi', $this->converter->prefectureEnglishNameById(39));
        $this->assertSame('fukuoka', $this->converter->prefectureEnglishNameById(40));
        $this->assertSame('saga', $this->converter->prefectureEnglishNameById(41));
        $this->assertSame('nagasaki', $this->converter->prefectureEnglishNameById(42));
        $this->assertSame('kumamoto', $this->converter->prefectureEnglishNameById(43));
        $this->assertSame('oita', $this->converter->prefectureEnglishNameById(44));
        $this->assertSame('miyazaki', $this->converter->prefectureEnglishNameById(45));
        $this->assertSame('kagoshima', $this->converter->prefectureEnglishNameById(46));
        $this->assertSame('okinawa', $this->converter->prefectureEnglishNameById(47));
        $this->assertNull($this->converter->prefectureEnglishNameById(48));
        $this->assertNull($this->converter->prefectureEnglishNameById(null));
    }

    /**
     * @return void
     */
    public function testPrefectureEnglishNameByName(): void
    {
        $this->assertSame('hokkaido', $this->converter->prefectureEnglishNameByName('北海道'));
        $this->assertSame('aomori', $this->converter->prefectureEnglishNameByName('青森県'));
        $this->assertSame('iwate', $this->converter->prefectureEnglishNameByName('岩手県'));
        $this->assertSame('miyagi', $this->converter->prefectureEnglishNameByName('宮城県'));
        $this->assertSame('akita', $this->converter->prefectureEnglishNameByName('秋田県'));
        $this->assertSame('yamagata', $this->converter->prefectureEnglishNameByName('山形県'));
        $this->assertSame('fukushima', $this->converter->prefectureEnglishNameByName('福島県'));
        $this->assertSame('ibaraki', $this->converter->prefectureEnglishNameByName('茨城県'));
        $this->assertSame('tochigi', $this->converter->prefectureEnglishNameByName('栃木県'));
        $this->assertSame('gunma', $this->converter->prefectureEnglishNameByName('群馬県'));
        $this->assertSame('saitama', $this->converter->prefectureEnglishNameByName('埼玉県'));
        $this->assertSame('chiba', $this->converter->prefectureEnglishNameByName('千葉県'));
        $this->assertSame('tokyo', $this->converter->prefectureEnglishNameByName('東京都'));
        $this->assertSame('kanagawa', $this->converter->prefectureEnglishNameByName('神奈川県'));
        $this->assertSame('niigata', $this->converter->prefectureEnglishNameByName('新潟県'));
        $this->assertSame('toyama', $this->converter->prefectureEnglishNameByName('富山県'));
        $this->assertSame('ishikawa', $this->converter->prefectureEnglishNameByName('石川県'));
        $this->assertSame('fukui', $this->converter->prefectureEnglishNameByName('福井県'));
        $this->assertSame('yamanashi', $this->converter->prefectureEnglishNameByName('山梨県'));
        $this->assertSame('nagano', $this->converter->prefectureEnglishNameByName('長野県'));
        $this->assertSame('gifu', $this->converter->prefectureEnglishNameByName('岐阜県'));
        $this->assertSame('shizuoka', $this->converter->prefectureEnglishNameByName('静岡県'));
        $this->assertSame('aichi', $this->converter->prefectureEnglishNameByName('愛知県'));
        $this->assertSame('mie', $this->converter->prefectureEnglishNameByName('三重県'));
        $this->assertSame('shiga', $this->converter->prefectureEnglishNameByName('滋賀県'));
        $this->assertSame('kyoto', $this->converter->prefectureEnglishNameByName('京都府'));
        $this->assertSame('osaka', $this->converter->prefectureEnglishNameByName('大阪府'));
        $this->assertSame('hyogo', $this->converter->prefectureEnglishNameByName('兵庫県'));
        $this->assertSame('nara', $this->converter->prefectureEnglishNameByName('奈良県'));
        $this->assertSame('wakayama', $this->converter->prefectureEnglishNameByName('和歌山県'));
        $this->assertSame('tottori', $this->converter->prefectureEnglishNameByName('鳥取県'));
        $this->assertSame('shimane', $this->converter->prefectureEnglishNameByName('島根県'));
        $this->assertSame('okayama', $this->converter->prefectureEnglishNameByName('岡山県'));
        $this->assertSame('hiroshima', $this->converter->prefectureEnglishNameByName('広島県'));
        $this->assertSame('yamaguchi', $this->converter->prefectureEnglishNameByName('山口県'));
        $this->assertSame('tokushima', $this->converter->prefectureEnglishNameByName('徳島県'));
        $this->assertSame('kagawa', $this->converter->prefectureEnglishNameByName('香川県'));
        $this->assertSame('ehime', $this->converter->prefectureEnglishNameByName('愛媛県'));
        $this->assertSame('kochi', $this->converter->prefectureEnglishNameByName('高知県'));
        $this->assertSame('fukuoka', $this->converter->prefectureEnglishNameByName('福岡県'));
        $this->assertSame('saga', $this->converter->prefectureEnglishNameByName('佐賀県'));
        $this->assertSame('nagasaki', $this->converter->prefectureEnglishNameByName('長崎県'));
        $this->assertSame('kumamoto', $this->converter->prefectureEnglishNameByName('熊本県'));
        $this->assertSame('oita', $this->converter->prefectureEnglishNameByName('大分県'));
        $this->assertSame('miyazaki', $this->converter->prefectureEnglishNameByName('宮崎県'));
        $this->assertSame('kagoshima', $this->converter->prefectureEnglishNameByName('鹿児島県'));
        $this->assertSame('okinawa', $this->converter->prefectureEnglishNameByName('沖縄県'));
        $this->assertNull($this->converter->prefectureEnglishNameByName('競艇'));
        $this->assertNull($this->converter->prefectureEnglishNameByName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureEnglishNameByShortName(): void
    {
        $this->assertSame('hokkaido', $this->converter->prefectureEnglishNameByShortName('北海道'));
        $this->assertSame('aomori', $this->converter->prefectureEnglishNameByShortName('青森'));
        $this->assertSame('iwate', $this->converter->prefectureEnglishNameByShortName('岩手'));
        $this->assertSame('miyagi', $this->converter->prefectureEnglishNameByShortName('宮城'));
        $this->assertSame('akita', $this->converter->prefectureEnglishNameByShortName('秋田'));
        $this->assertSame('yamagata', $this->converter->prefectureEnglishNameByShortName('山形'));
        $this->assertSame('fukushima', $this->converter->prefectureEnglishNameByShortName('福島'));
        $this->assertSame('ibaraki', $this->converter->prefectureEnglishNameByShortName('茨城'));
        $this->assertSame('tochigi', $this->converter->prefectureEnglishNameByShortName('栃木'));
        $this->assertSame('gunma', $this->converter->prefectureEnglishNameByShortName('群馬'));
        $this->assertSame('saitama', $this->converter->prefectureEnglishNameByShortName('埼玉'));
        $this->assertSame('chiba', $this->converter->prefectureEnglishNameByShortName('千葉'));
        $this->assertSame('tokyo', $this->converter->prefectureEnglishNameByShortName('東京'));
        $this->assertSame('kanagawa', $this->converter->prefectureEnglishNameByShortName('神奈川'));
        $this->assertSame('niigata', $this->converter->prefectureEnglishNameByShortName('新潟'));
        $this->assertSame('toyama', $this->converter->prefectureEnglishNameByShortName('富山'));
        $this->assertSame('ishikawa', $this->converter->prefectureEnglishNameByShortName('石川'));
        $this->assertSame('fukui', $this->converter->prefectureEnglishNameByShortName('福井'));
        $this->assertSame('yamanashi', $this->converter->prefectureEnglishNameByShortName('山梨'));
        $this->assertSame('nagano', $this->converter->prefectureEnglishNameByShortName('長野'));
        $this->assertSame('gifu', $this->converter->prefectureEnglishNameByShortName('岐阜'));
        $this->assertSame('shizuoka', $this->converter->prefectureEnglishNameByShortName('静岡'));
        $this->assertSame('aichi', $this->converter->prefectureEnglishNameByShortName('愛知'));
        $this->assertSame('mie', $this->converter->prefectureEnglishNameByShortName('三重'));
        $this->assertSame('shiga', $this->converter->prefectureEnglishNameByShortName('滋賀'));
        $this->assertSame('kyoto', $this->converter->prefectureEnglishNameByShortName('京都'));
        $this->assertSame('osaka', $this->converter->prefectureEnglishNameByShortName('大阪'));
        $this->assertSame('hyogo', $this->converter->prefectureEnglishNameByShortName('兵庫'));
        $this->assertSame('nara', $this->converter->prefectureEnglishNameByShortName('奈良'));
        $this->assertSame('wakayama', $this->converter->prefectureEnglishNameByShortName('和歌山'));
        $this->assertSame('tottori', $this->converter->prefectureEnglishNameByShortName('鳥取'));
        $this->assertSame('shimane', $this->converter->prefectureEnglishNameByShortName('島根'));
        $this->assertSame('okayama', $this->converter->prefectureEnglishNameByShortName('岡山'));
        $this->assertSame('hiroshima', $this->converter->prefectureEnglishNameByShortName('広島'));
        $this->assertSame('yamaguchi', $this->converter->prefectureEnglishNameByShortName('山口'));
        $this->assertSame('tokushima', $this->converter->prefectureEnglishNameByShortName('徳島'));
        $this->assertSame('kagawa', $this->converter->prefectureEnglishNameByShortName('香川'));
        $this->assertSame('ehime', $this->converter->prefectureEnglishNameByShortName('愛媛'));
        $this->assertSame('kochi', $this->converter->prefectureEnglishNameByShortName('高知'));
        $this->assertSame('fukuoka', $this->converter->prefectureEnglishNameByShortName('福岡'));
        $this->assertSame('saga', $this->converter->prefectureEnglishNameByShortName('佐賀'));
        $this->assertSame('nagasaki', $this->converter->prefectureEnglishNameByShortName('長崎'));
        $this->assertSame('kumamoto', $this->converter->prefectureEnglishNameByShortName('熊本'));
        $this->assertSame('oita', $this->converter->prefectureEnglishNameByShortName('大分'));
        $this->assertSame('miyazaki', $this->converter->prefectureEnglishNameByShortName('宮崎'));
        $this->assertSame('kagoshima', $this->converter->prefectureEnglishNameByShortName('鹿児島'));
        $this->assertSame('okinawa', $this->converter->prefectureEnglishNameByShortName('沖縄'));
        $this->assertNull($this->converter->prefectureEnglishNameByShortName('kyotei'));
        $this->assertNull($this->converter->prefectureEnglishNameByShortName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureEnglishNameByHiraganaName(): void
    {
        $this->assertSame('hokkaido', $this->converter->prefectureEnglishNameByHiraganaName('ほっかいどう'));
        $this->assertSame('aomori', $this->converter->prefectureEnglishNameByHiraganaName('あおもりけん'));
        $this->assertSame('iwate', $this->converter->prefectureEnglishNameByHiraganaName('いわてけん'));
        $this->assertSame('miyagi', $this->converter->prefectureEnglishNameByHiraganaName('みやぎけん'));
        $this->assertSame('akita', $this->converter->prefectureEnglishNameByHiraganaName('あきたけん'));
        $this->assertSame('yamagata', $this->converter->prefectureEnglishNameByHiraganaName('やまがたけん'));
        $this->assertSame('fukushima', $this->converter->prefectureEnglishNameByHiraganaName('ふくしまけん'));
        $this->assertSame('ibaraki', $this->converter->prefectureEnglishNameByHiraganaName('いばらきけん'));
        $this->assertSame('tochigi', $this->converter->prefectureEnglishNameByHiraganaName('とちぎけん'));
        $this->assertSame('gunma', $this->converter->prefectureEnglishNameByHiraganaName('ぐんまけん'));
        $this->assertSame('saitama', $this->converter->prefectureEnglishNameByHiraganaName('さいたまけん'));
        $this->assertSame('chiba', $this->converter->prefectureEnglishNameByHiraganaName('ちばけん'));
        $this->assertSame('tokyo', $this->converter->prefectureEnglishNameByHiraganaName('とうきょうと'));
        $this->assertSame('kanagawa', $this->converter->prefectureEnglishNameByHiraganaName('かながわけん'));
        $this->assertSame('niigata', $this->converter->prefectureEnglishNameByHiraganaName('にいがたけん'));
        $this->assertSame('toyama', $this->converter->prefectureEnglishNameByHiraganaName('とやまけん'));
        $this->assertSame('ishikawa', $this->converter->prefectureEnglishNameByHiraganaName('いしかわけん'));
        $this->assertSame('fukui', $this->converter->prefectureEnglishNameByHiraganaName('ふくいけん'));
        $this->assertSame('yamanashi', $this->converter->prefectureEnglishNameByHiraganaName('やまなしけん'));
        $this->assertSame('nagano', $this->converter->prefectureEnglishNameByHiraganaName('ながのけん'));
        $this->assertSame('gifu', $this->converter->prefectureEnglishNameByHiraganaName('ぎふけん'));
        $this->assertSame('shizuoka', $this->converter->prefectureEnglishNameByHiraganaName('しずおかけん'));
        $this->assertSame('aichi', $this->converter->prefectureEnglishNameByHiraganaName('あいちけん'));
        $this->assertSame('mie', $this->converter->prefectureEnglishNameByHiraganaName('みえけん'));
        $this->assertSame('shiga', $this->converter->prefectureEnglishNameByHiraganaName('しがけん'));
        $this->assertSame('kyoto', $this->converter->prefectureEnglishNameByHiraganaName('きょうとふ'));
        $this->assertSame('osaka', $this->converter->prefectureEnglishNameByHiraganaName('おおさかふ'));
        $this->assertSame('hyogo', $this->converter->prefectureEnglishNameByHiraganaName('ひょうごけん'));
        $this->assertSame('nara', $this->converter->prefectureEnglishNameByHiraganaName('ならけん'));
        $this->assertSame('wakayama', $this->converter->prefectureEnglishNameByHiraganaName('わかやまけん'));
        $this->assertSame('tottori', $this->converter->prefectureEnglishNameByHiraganaName('とっとりけん'));
        $this->assertSame('shimane', $this->converter->prefectureEnglishNameByHiraganaName('しまねけん'));
        $this->assertSame('okayama', $this->converter->prefectureEnglishNameByHiraganaName('おかやまけん'));
        $this->assertSame('hiroshima', $this->converter->prefectureEnglishNameByHiraganaName('ひろしまけん'));
        $this->assertSame('yamaguchi', $this->converter->prefectureEnglishNameByHiraganaName('やまぐちけん'));
        $this->assertSame('tokushima', $this->converter->prefectureEnglishNameByHiraganaName('とくしまけん'));
        $this->assertSame('kagawa', $this->converter->prefectureEnglishNameByHiraganaName('かがわけん'));
        $this->assertSame('ehime', $this->converter->prefectureEnglishNameByHiraganaName('えひめけん'));
        $this->assertSame('kochi', $this->converter->prefectureEnglishNameByHiraganaName('こうちけん'));
        $this->assertSame('fukuoka', $this->converter->prefectureEnglishNameByHiraganaName('ふくおかけん'));
        $this->assertSame('saga', $this->converter->prefectureEnglishNameByHiraganaName('さがけん'));
        $this->assertSame('nagasaki', $this->converter->prefectureEnglishNameByHiraganaName('ながさきけん'));
        $this->assertSame('kumamoto', $this->converter->prefectureEnglishNameByHiraganaName('くまもとけん'));
        $this->assertSame('oita', $this->converter->prefectureEnglishNameByHiraganaName('おおいたけん'));
        $this->assertSame('miyazaki', $this->converter->prefectureEnglishNameByHiraganaName('みやざきけん'));
        $this->assertSame('kagoshima', $this->converter->prefectureEnglishNameByHiraganaName('かごしまけん'));
        $this->assertSame('okinawa', $this->converter->prefectureEnglishNameByHiraganaName('おきなわけん'));
        $this->assertNull($this->converter->prefectureEnglishNameByHiraganaName('きょうてい'));
        $this->assertNull($this->converter->prefectureEnglishNameByHiraganaName(null));
    }

    /**
     * @return void
     */
    public function testPrefectureEnglishNameByKatakanaName(): void
    {
        $this->assertSame('hokkaido', $this->converter->prefectureEnglishNameByKatakanaName('ホッカイドウ'));
        $this->assertSame('aomori', $this->converter->prefectureEnglishNameByKatakanaName('アオモリケン'));
        $this->assertSame('iwate', $this->converter->prefectureEnglishNameByKatakanaName('イワテケン'));
        $this->assertSame('miyagi', $this->converter->prefectureEnglishNameByKatakanaName('ミヤギケン'));
        $this->assertSame('akita', $this->converter->prefectureEnglishNameByKatakanaName('アキタケン'));
        $this->assertSame('yamagata', $this->converter->prefectureEnglishNameByKatakanaName('ヤマガタケン'));
        $this->assertSame('fukushima', $this->converter->prefectureEnglishNameByKatakanaName('フクシマケン'));
        $this->assertSame('ibaraki', $this->converter->prefectureEnglishNameByKatakanaName('イバラキケン'));
        $this->assertSame('tochigi', $this->converter->prefectureEnglishNameByKatakanaName('トチギケン'));
        $this->assertSame('gunma', $this->converter->prefectureEnglishNameByKatakanaName('グンマケン'));
        $this->assertSame('saitama', $this->converter->prefectureEnglishNameByKatakanaName('サイタマケン'));
        $this->assertSame('chiba', $this->converter->prefectureEnglishNameByKatakanaName('チバケン'));
        $this->assertSame('tokyo', $this->converter->prefectureEnglishNameByKatakanaName('トウキョウト'));
        $this->assertSame('kanagawa', $this->converter->prefectureEnglishNameByKatakanaName('カナガワケン'));
        $this->assertSame('niigata', $this->converter->prefectureEnglishNameByKatakanaName('ニイガタケン'));
        $this->assertSame('toyama', $this->converter->prefectureEnglishNameByKatakanaName('トヤマケン'));
        $this->assertSame('ishikawa', $this->converter->prefectureEnglishNameByKatakanaName('イシカワケン'));
        $this->assertSame('fukui', $this->converter->prefectureEnglishNameByKatakanaName('フクイケン'));
        $this->assertSame('yamanashi', $this->converter->prefectureEnglishNameByKatakanaName('ヤマナシケン'));
        $this->assertSame('nagano', $this->converter->prefectureEnglishNameByKatakanaName('ナガノケン'));
        $this->assertSame('gifu', $this->converter->prefectureEnglishNameByKatakanaName('ギフケン'));
        $this->assertSame('shizuoka', $this->converter->prefectureEnglishNameByKatakanaName('シズオカケン'));
        $this->assertSame('aichi', $this->converter->prefectureEnglishNameByKatakanaName('アイチケン'));
        $this->assertSame('mie', $this->converter->prefectureEnglishNameByKatakanaName('ミエケン'));
        $this->assertSame('shiga', $this->converter->prefectureEnglishNameByKatakanaName('シガケン'));
        $this->assertSame('kyoto', $this->converter->prefectureEnglishNameByKatakanaName('キョウトフ'));
        $this->assertSame('osaka', $this->converter->prefectureEnglishNameByKatakanaName('オオサカフ'));
        $this->assertSame('hyogo', $this->converter->prefectureEnglishNameByKatakanaName('ヒョウゴケン'));
        $this->assertSame('nara', $this->converter->prefectureEnglishNameByKatakanaName('ナラケン'));
        $this->assertSame('wakayama', $this->converter->prefectureEnglishNameByKatakanaName('ワカヤマケン'));
        $this->assertSame('tottori', $this->converter->prefectureEnglishNameByKatakanaName('トットリケン'));
        $this->assertSame('shimane', $this->converter->prefectureEnglishNameByKatakanaName('シマネケン'));
        $this->assertSame('okayama', $this->converter->prefectureEnglishNameByKatakanaName('オカヤマケン'));
        $this->assertSame('hiroshima', $this->converter->prefectureEnglishNameByKatakanaName('ヒロシマケン'));
        $this->assertSame('yamaguchi', $this->converter->prefectureEnglishNameByKatakanaName('ヤマグチケン'));
        $this->assertSame('tokushima', $this->converter->prefectureEnglishNameByKatakanaName('トクシマケン'));
        $this->assertSame('kagawa', $this->converter->prefectureEnglishNameByKatakanaName('カガワケン'));
        $this->assertSame('ehime', $this->converter->prefectureEnglishNameByKatakanaName('エヒメケン'));
        $this->assertSame('kochi', $this->converter->prefectureEnglishNameByKatakanaName('コウチケン'));
        $this->assertSame('fukuoka', $this->converter->prefectureEnglishNameByKatakanaName('フクオカケン'));
        $this->assertSame('saga', $this->converter->prefectureEnglishNameByKatakanaName('サガケン'));
        $this->assertSame('nagasaki', $this->converter->prefectureEnglishNameByKatakanaName('ナガサキケン'));
        $this->assertSame('kumamoto', $this->converter->prefectureEnglishNameByKatakanaName('クマモトケン'));
        $this->assertSame('oita', $this->converter->prefectureEnglishNameByKatakanaName('オオイタケン'));
        $this->assertSame('miyazaki', $this->converter->prefectureEnglishNameByKatakanaName('ミヤザキケン'));
        $this->assertSame('kagoshima', $this->converter->prefectureEnglishNameByKatakanaName('カゴシマケン'));
        $this->assertSame('okinawa', $this->converter->prefectureEnglishNameByKatakanaName('オキナワケン'));
        $this->assertNull($this->converter->prefectureEnglishNameByKatakanaName('キョウテイ'));
        $this->assertNull($this->converter->prefectureEnglishNameByKatakanaName(null));
    }

    /**
     * @return void
     */
    public function testStadiumIdByName(): void
    {
        $this->assertSame(1, $this->converter->stadiumIdByName('ボートレース桐生'));
        $this->assertSame(2, $this->converter->stadiumIdByName('ボートレース戸田'));
        $this->assertSame(3, $this->converter->stadiumIdByName('ボートレース江戸川'));
        $this->assertSame(4, $this->converter->stadiumIdByName('ボートレース平和島'));
        $this->assertSame(5, $this->converter->stadiumIdByName('ボートレース多摩川'));
        $this->assertSame(6, $this->converter->stadiumIdByName('ボートレース浜名湖'));
        $this->assertSame(7, $this->converter->stadiumIdByName('ボートレース蒲郡'));
        $this->assertSame(8, $this->converter->stadiumIdByName('ボートレース常滑'));
        $this->assertSame(9, $this->converter->stadiumIdByName('ボートレース津'));
        $this->assertSame(10, $this->converter->stadiumIdByName('ボートレース三国'));
        $this->assertSame(11, $this->converter->stadiumIdByName('ボートレースびわこ'));
        $this->assertSame(12, $this->converter->stadiumIdByName('ボートレース住之江'));
        $this->assertSame(13, $this->converter->stadiumIdByName('ボートレース尼崎'));
        $this->assertSame(14, $this->converter->stadiumIdByName('ボートレース鳴門'));
        $this->assertSame(15, $this->converter->stadiumIdByName('ボートレース丸亀'));
        $this->assertSame(16, $this->converter->stadiumIdByName('ボートレース児島'));
        $this->assertSame(17, $this->converter->stadiumIdByName('ボートレース宮島'));
        $this->assertSame(18, $this->converter->stadiumIdByName('ボートレース徳山'));
        $this->assertSame(19, $this->converter->stadiumIdByName('ボートレース下関'));
        $this->assertSame(20, $this->converter->stadiumIdByName('ボートレース若松'));
        $this->assertSame(21, $this->converter->stadiumIdByName('ボートレース芦屋'));
        $this->assertSame(22, $this->converter->stadiumIdByName('ボートレース福岡'));
        $this->assertSame(23, $this->converter->stadiumIdByName('ボートレース唐津'));
        $this->assertSame(24, $this->converter->stadiumIdByName('ボートレース大村'));
        $this->assertNull($this->converter->stadiumIdByName('競艇'));
        $this->assertNull($this->converter->stadiumIdByName(null));
    }

    /**
     * @return void
     */
    public function testStadiumIdByShortName(): void
    {
        $this->assertSame(1, $this->converter->stadiumIdByShortName('桐生'));
        $this->assertSame(2, $this->converter->stadiumIdByShortName('戸田'));
        $this->assertSame(3, $this->converter->stadiumIdByShortName('江戸川'));
        $this->assertSame(4, $this->converter->stadiumIdByShortName('平和島'));
        $this->assertSame(5, $this->converter->stadiumIdByShortName('多摩川'));
        $this->assertSame(6, $this->converter->stadiumIdByShortName('浜名湖'));
        $this->assertSame(7, $this->converter->stadiumIdByShortName('蒲郡'));
        $this->assertSame(8, $this->converter->stadiumIdByShortName('常滑'));
        $this->assertSame(9, $this->converter->stadiumIdByShortName('津'));
        $this->assertSame(10, $this->converter->stadiumIdByShortName('三国'));
        $this->assertSame(11, $this->converter->stadiumIdByShortName('びわこ'));
        $this->assertSame(12, $this->converter->stadiumIdByShortName('住之江'));
        $this->assertSame(13, $this->converter->stadiumIdByShortName('尼崎'));
        $this->assertSame(14, $this->converter->stadiumIdByShortName('鳴門'));
        $this->assertSame(15, $this->converter->stadiumIdByShortName('丸亀'));
        $this->assertSame(16, $this->converter->stadiumIdByShortName('児島'));
        $this->assertSame(17, $this->converter->stadiumIdByShortName('宮島'));
        $this->assertSame(18, $this->converter->stadiumIdByShortName('徳山'));
        $this->assertSame(19, $this->converter->stadiumIdByShortName('下関'));
        $this->assertSame(20, $this->converter->stadiumIdByShortName('若松'));
        $this->assertSame(21, $this->converter->stadiumIdByShortName('芦屋'));
        $this->assertSame(22, $this->converter->stadiumIdByShortName('福岡'));
        $this->assertSame(23, $this->converter->stadiumIdByShortName('唐津'));
        $this->assertSame(24, $this->converter->stadiumIdByShortName('大村'));
        $this->assertNull($this->converter->stadiumIdByShortName('競艇'));
        $this->assertNull($this->converter->stadiumIdByShortName(null));
    }

    /**
     * @return void
     */
    public function testStadiumNameById(): void
    {
        $this->assertSame('ボートレース桐生', $this->converter->stadiumNameById(1));
        $this->assertSame('ボートレース戸田', $this->converter->stadiumNameById(2));
        $this->assertSame('ボートレース江戸川', $this->converter->stadiumNameById(3));
        $this->assertSame('ボートレース平和島', $this->converter->stadiumNameById(4));
        $this->assertSame('ボートレース多摩川', $this->converter->stadiumNameById(5));
        $this->assertSame('ボートレース浜名湖', $this->converter->stadiumNameById(6));
        $this->assertSame('ボートレース蒲郡', $this->converter->stadiumNameById(7));
        $this->assertSame('ボートレース常滑', $this->converter->stadiumNameById(8));
        $this->assertSame('ボートレース津', $this->converter->stadiumNameById(9));
        $this->assertSame('ボートレース三国', $this->converter->stadiumNameById(10));
        $this->assertSame('ボートレースびわこ', $this->converter->stadiumNameById(11));
        $this->assertSame('ボートレース住之江', $this->converter->stadiumNameById(12));
        $this->assertSame('ボートレース尼崎', $this->converter->stadiumNameById(13));
        $this->assertSame('ボートレース鳴門', $this->converter->stadiumNameById(14));
        $this->assertSame('ボートレース丸亀', $this->converter->stadiumNameById(15));
        $this->assertSame('ボートレース児島', $this->converter->stadiumNameById(16));
        $this->assertSame('ボートレース宮島', $this->converter->stadiumNameById(17));
        $this->assertSame('ボートレース徳山', $this->converter->stadiumNameById(18));
        $this->assertSame('ボートレース下関', $this->converter->stadiumNameById(19));
        $this->assertSame('ボートレース若松', $this->converter->stadiumNameById(20));
        $this->assertSame('ボートレース芦屋', $this->converter->stadiumNameById(21));
        $this->assertSame('ボートレース福岡', $this->converter->stadiumNameById(22));
        $this->assertSame('ボートレース唐津', $this->converter->stadiumNameById(23));
        $this->assertSame('ボートレース大村', $this->converter->stadiumNameById(24));
        $this->assertNull($this->converter->stadiumNameById(25));
        $this->assertNull($this->converter->stadiumNameById(null));
    }

    /**
     * @return void
     */
    public function testStadiumNameByShortName(): void
    {
        $this->assertSame('ボートレース桐生', $this->converter->stadiumNameByShortName('桐生'));
        $this->assertSame('ボートレース戸田', $this->converter->stadiumNameByShortName('戸田'));
        $this->assertSame('ボートレース江戸川', $this->converter->stadiumNameByShortName('江戸川'));
        $this->assertSame('ボートレース平和島', $this->converter->stadiumNameByShortName('平和島'));
        $this->assertSame('ボートレース多摩川', $this->converter->stadiumNameByShortName('多摩川'));
        $this->assertSame('ボートレース浜名湖', $this->converter->stadiumNameByShortName('浜名湖'));
        $this->assertSame('ボートレース蒲郡', $this->converter->stadiumNameByShortName('蒲郡'));
        $this->assertSame('ボートレース常滑', $this->converter->stadiumNameByShortName('常滑'));
        $this->assertSame('ボートレース津', $this->converter->stadiumNameByShortName('津'));
        $this->assertSame('ボートレース三国', $this->converter->stadiumNameByShortName('三国'));
        $this->assertSame('ボートレースびわこ', $this->converter->stadiumNameByShortName('びわこ'));
        $this->assertSame('ボートレース住之江', $this->converter->stadiumNameByShortName('住之江'));
        $this->assertSame('ボートレース尼崎', $this->converter->stadiumNameByShortName('尼崎'));
        $this->assertSame('ボートレース鳴門', $this->converter->stadiumNameByShortName('鳴門'));
        $this->assertSame('ボートレース丸亀', $this->converter->stadiumNameByShortName('丸亀'));
        $this->assertSame('ボートレース児島', $this->converter->stadiumNameByShortName('児島'));
        $this->assertSame('ボートレース宮島', $this->converter->stadiumNameByShortName('宮島'));
        $this->assertSame('ボートレース徳山', $this->converter->stadiumNameByShortName('徳山'));
        $this->assertSame('ボートレース下関', $this->converter->stadiumNameByShortName('下関'));
        $this->assertSame('ボートレース若松', $this->converter->stadiumNameByShortName('若松'));
        $this->assertSame('ボートレース芦屋', $this->converter->stadiumNameByShortName('芦屋'));
        $this->assertSame('ボートレース福岡', $this->converter->stadiumNameByShortName('福岡'));
        $this->assertSame('ボートレース唐津', $this->converter->stadiumNameByShortName('唐津'));
        $this->assertSame('ボートレース大村', $this->converter->stadiumNameByShortName('大村'));
        $this->assertNull($this->converter->stadiumNameByShortName('競艇'));
        $this->assertNull($this->converter->stadiumNameByShortName(null));
    }

    /**
     * @return void
     */
    public function testStadiumShortNameById(): void
    {
        $this->assertSame('桐生', $this->converter->stadiumShortNameById(1));
        $this->assertSame('戸田', $this->converter->stadiumShortNameById(2));
        $this->assertSame('江戸川', $this->converter->stadiumShortNameById(3));
        $this->assertSame('平和島', $this->converter->stadiumShortNameById(4));
        $this->assertSame('多摩川', $this->converter->stadiumShortNameById(5));
        $this->assertSame('浜名湖', $this->converter->stadiumShortNameById(6));
        $this->assertSame('蒲郡', $this->converter->stadiumShortNameById(7));
        $this->assertSame('常滑', $this->converter->stadiumShortNameById(8));
        $this->assertSame('津', $this->converter->stadiumShortNameById(9));
        $this->assertSame('三国', $this->converter->stadiumShortNameById(10));
        $this->assertSame('びわこ', $this->converter->stadiumShortNameById(11));
        $this->assertSame('住之江', $this->converter->stadiumShortNameById(12));
        $this->assertSame('尼崎', $this->converter->stadiumShortNameById(13));
        $this->assertSame('鳴門', $this->converter->stadiumShortNameById(14));
        $this->assertSame('丸亀', $this->converter->stadiumShortNameById(15));
        $this->assertSame('児島', $this->converter->stadiumShortNameById(16));
        $this->assertSame('宮島', $this->converter->stadiumShortNameById(17));
        $this->assertSame('徳山', $this->converter->stadiumShortNameById(18));
        $this->assertSame('下関', $this->converter->stadiumShortNameById(19));
        $this->assertSame('若松', $this->converter->stadiumShortNameById(20));
        $this->assertSame('芦屋', $this->converter->stadiumShortNameById(21));
        $this->assertSame('福岡', $this->converter->stadiumShortNameById(22));
        $this->assertSame('唐津', $this->converter->stadiumShortNameById(23));
        $this->assertSame('大村', $this->converter->stadiumShortNameById(24));
        $this->assertNull($this->converter->stadiumShortNameById(25));
        $this->assertNull($this->converter->stadiumShortNameById(null));
    }

    /**
     * @return void
     */
    public function testStadiumShortNameByName(): void
    {
        $this->assertSame('桐生', $this->converter->stadiumShortNameByName('ボートレース桐生'));
        $this->assertSame('戸田', $this->converter->stadiumShortNameByName('ボートレース戸田'));
        $this->assertSame('江戸川', $this->converter->stadiumShortNameByName('ボートレース江戸川'));
        $this->assertSame('平和島', $this->converter->stadiumShortNameByName('ボートレース平和島'));
        $this->assertSame('多摩川', $this->converter->stadiumShortNameByName('ボートレース多摩川'));
        $this->assertSame('浜名湖', $this->converter->stadiumShortNameByName('ボートレース浜名湖'));
        $this->assertSame('蒲郡', $this->converter->stadiumShortNameByName('ボートレース蒲郡'));
        $this->assertSame('常滑', $this->converter->stadiumShortNameByName('ボートレース常滑'));
        $this->assertSame('津', $this->converter->stadiumShortNameByName('ボートレース津'));
        $this->assertSame('三国', $this->converter->stadiumShortNameByName('ボートレース三国'));
        $this->assertSame('びわこ', $this->converter->stadiumShortNameByName('ボートレースびわこ'));
        $this->assertSame('住之江', $this->converter->stadiumShortNameByName('ボートレース住之江'));
        $this->assertSame('尼崎', $this->converter->stadiumShortNameByName('ボートレース尼崎'));
        $this->assertSame('鳴門', $this->converter->stadiumShortNameByName('ボートレース鳴門'));
        $this->assertSame('丸亀', $this->converter->stadiumShortNameByName('ボートレース丸亀'));
        $this->assertSame('児島', $this->converter->stadiumShortNameByName('ボートレース児島'));
        $this->assertSame('宮島', $this->converter->stadiumShortNameByName('ボートレース宮島'));
        $this->assertSame('徳山', $this->converter->stadiumShortNameByName('ボートレース徳山'));
        $this->assertSame('下関', $this->converter->stadiumShortNameByName('ボートレース下関'));
        $this->assertSame('若松', $this->converter->stadiumShortNameByName('ボートレース若松'));
        $this->assertSame('芦屋', $this->converter->stadiumShortNameByName('ボートレース芦屋'));
        $this->assertSame('福岡', $this->converter->stadiumShortNameByName('ボートレース福岡'));
        $this->assertSame('唐津', $this->converter->stadiumShortNameByName('ボートレース唐津'));
        $this->assertSame('大村', $this->converter->stadiumShortNameByName('ボートレース大村'));
        $this->assertNull($this->converter->stadiumShortNameByName('競艇'));
        $this->assertNull($this->converter->stadiumShortNameByName(null));
    }
}
