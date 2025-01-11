<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project;

use Carbon\CarbonImmutable as Carbon;

/**
 * @author shimomo
 */
class MainConverter
{
    /**
     * @param  string|float|int|null  $value
     * @return string|null
     */
    public function string(string|float|int|null $value): ?string
    {
        if (is_null($value)) {
            return $value;
        }

        return Trimmer::trim(
            mb_convert_kana($value, 'as', 'utf-8')
        );
    }

    /**
     * @param  string|float|int|null  $value
     * @return float|null
     */
    public function float(string|float|int|null $value): ?float
    {
        if (is_null($value)) {
            return $value;
        }

        return (float) $this->string($value);
    }

    /**
     * @param  string|float|int|null  $value
     * @return int|null
     */
    public function int(string|float|int|null $value): ?int
    {
        if (is_null($value)) {
            return $value;
        }

        return (int) $this->string($value);
    }

    /**
     * @param  string|null  $value
     * @return string|null
     */
    public function name(?string $value): ?string
    {
        if (is_null($value)) {
            return $value;
        }

        $pattern = '/[\\x0-\x20\x7f\xc2\xa0\xe3\x80\x80]++/u';
        $subject = $this->string($value);
        $array = preg_split($pattern, $subject, -1, PREG_SPLIT_NO_EMPTY) + [1 => ''];
        return implode(' ', $array);
    }

    /**
     * @param  string|null  $value
     * @return int|null
     */
    public function flying(?string $value): ?int
    {
        if (is_null($value)) {
            return $value;
        }

        return (int) Trimmer::ltrim($this->string($value), 'F');
    }

    /**
     * @param  string|null  $value
     * @return int|null
     */
    public function late(?string $value): ?int
    {
        if (is_null($value)) {
            return $value;
        }

        return (int) Trimmer::ltrim($this->string($value), 'L');
    }

    /**
     * @param  string|null  $value
     * @return float|null
     */
    public function startTiming(?string $value): ?float
    {
        if (is_null($value)) {
            return $value;
        }

        return match (substr($value = $this->string($value), 0, 1)) {
            'F' => $this->float('-1'),
            'L' => $this->float('1'),
            default => (float) sprintf('%d%s', 0, preg_replace('/[^0-9.]/u', '', $value)),
        };
    }

    /**
     * @param  string|null  $value
     * @return int|null
     */
    public function wind(?string $value): ?int
    {
        if (is_null($value)) {
            return $value;
        }

        return (int) Trimmer::rtrim($this->string($value), 'm');
    }

    /**
     * @param  string|null  $value
     * @return int|null
     */
    public function wave(?string $value): ?int
    {
        if (is_null($value)) {
            return $value;
        }

        return (int) Trimmer::rtrim($this->string($value), 'cm');
    }

    /**
     * @param  string|null  $value
     * @return float|null
     */
    public function temperature(?string $value): ?float
    {
        if (is_null($value)) {
            return $value;
        }

        return (float) Trimmer::rtrim($this->string($value), '℃');
    }

    /**
     * @param  string|null  $value
     * @return string|null
     */
    public function date(?string $value): ?string
    {
        if (is_null($value)) {
            return $value;
        }

        return Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * @param  string|null  $value
     * @return string|null
     */
    public function dateTime(?string $value): ?string
    {
        if (is_null($value)) {
            return $value;
        }

        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    /**
     * @param  string|null  $value
     * @return int|null
     */
    public function direction(?string $value): ?int
    {
        if (is_null($value)) {
            return $value;
        }

        $pattern = '/is-wind(\d+)/u';
        $subject = $this->string($value);
        return preg_match($pattern, $subject, $matches)
            ? (int) $matches[1]
            : null;
    }

    /**
     * @param  string|null  $name
     * @return int|null
     */
    public function directionIdByName(?string $name): ?int
    {
        return Terminology::directionByName($this->string($name))?->get('id');
    }

    /**
     * @param  string|null  $shortName
     * @return int|null
     */
    public function directionIdByShortName(?string $shortName): ?int
    {
        return Terminology::directionByShortName($this->string($shortName))?->get('id');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function directionNameById(?int $id): ?string
    {
        return Terminology::directionById($id)?->get('name');
    }

    /**
     * @param  string|null  $shortName
     * @return string|null
     */
    public function directionNameByShortName(?string $shortName): ?string
    {
        return Terminology::directionByShortName($this->string($shortName))?->get('name');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function directionShortNameById(?int $id): ?string
    {
        return Terminology::directionById($id)?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return string|null
     */
    public function directionShortNameByName(?string $name): ?string
    {
        return Terminology::directionByName($this->string($name))?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return int|null
     */
    public function classIdByName(?string $name): ?int
    {
        return Terminology::classByName($this->string($name))?->get('id');
    }

    /**
     * @param  string|null  $shortName
     * @return int|null
     */
    public function classIdByShortName(?string $shortName): ?int
    {
        return Terminology::classByShortName($this->string($shortName))?->get('id');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function classNameById(?int $id): ?string
    {
        return Terminology::classById($id)?->get('name');
    }

    /**
     * @param  string|null  $shortName
     * @return string|null
     */
    public function classNameByShortName(?string $shortName): ?string
    {
        return Terminology::classByShortName($this->string($shortName))?->get('name');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function classShortNameById(?int $id): ?string
    {
        return Terminology::classById($id)?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return string|null
     */
    public function classShortNameByName(?string $name): ?string
    {
        return Terminology::classByName($this->string($name))?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return int|null
     */
    public function placeIdByName(?string $name): ?int
    {
        return Terminology::placeByName($this->string($name))?->get('id');
    }

    /**
     * @param  string|null  $shortName
     * @return int|null
     */
    public function placeIdByShortName(?string $shortName): ?int
    {
        return Terminology::placeByShortName($this->string($shortName))?->get('id');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function placeNameById(?int $id): ?string
    {
        return Terminology::placeById($id)?->get('name');
    }

    /**
     * @param  string|null  $shortName
     * @return string|null
     */
    public function placeNameByShortName(?string $shortName): ?string
    {
        return Terminology::placeByShortName($this->string($shortName))?->get('name');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function placeShortNameById(?int $id): ?string
    {
        return Terminology::placeById($id)?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return string|null
     */
    public function placeShortNameByName(?string $name): ?string
    {
        return Terminology::placeByName($name)?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return int|null
     */
    public function techniqueIdByName(?string $name): ?int
    {
        return Terminology::techniqueByName($this->string($name))?->get('id');
    }

    /**
     * @param  string|null  $shortName
     * @return int|null
     */
    public function techniqueIdByShortName(?string $shortName): ?int
    {
        return Terminology::techniqueByShortName($this->string($shortName))?->get('id');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function techniqueNameById(?int $id): ?string
    {
        return Terminology::techniqueById($id)?->get('name');
    }

    /**
     * @param  string|null  $shortName
     * @return string|null
     */
    public function techniqueNameByShortName(?string $shortName): ?string
    {
        return Terminology::techniqueByShortName($this->string($shortName))?->get('name');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function techniqueShortNameById(?int $id): ?string
    {
        return Terminology::techniqueById($id)?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return string|null
     */
    public function techniqueShortNameByName(?string $name): ?string
    {
        return Terminology::techniqueByName($this->string($name))?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return int|null
     */
    public function weatherIdByName(?string $name): ?int
    {
        return Terminology::weatherByName($this->string($name))?->get('id');
    }

    /**
     * @param  string|null  $shortName
     * @return int|null
     */
    public function weatherIdByShortName(?string $shortName): ?int
    {
        return Terminology::weatherByShortName($this->string($shortName))?->get('id');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function weatherNameById(?int $id): ?string
    {
        return Terminology::weatherById($id)?->get('name');
    }

    /**
     * @param  string|null  $shortName
     * @return string|null
     */
    public function weatherNameByShortName(?string $shortName): ?string
    {
        return Terminology::weatherByShortName($this->string($shortName))?->get('name');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function weatherShortNameById(?int $id): ?string
    {
        return Terminology::weatherById($id)?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return string|null
     */
    public function weatherShortNameByName(?string $name): ?string
    {
        return Terminology::weatherByName($this->string($name))?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return int|null
     */
    public function prefectureIdByName(?string $name): ?int
    {
        return Prefecture::byName($this->string($name))?->get('id');
    }

    /**
     * @param  string|null  $shortName
     * @return int|null
     */
    public function prefectureIdByShortName(?string $shortName): ?int
    {
        return Prefecture::byShortName($this->string($shortName))?->get('id');
    }

    /**
     * @param  string|null  $hiraganaName
     * @return int|null
     */
    public function prefectureIdByHiraganaName(?string $hiraganaName): ?int
    {
        return Prefecture::byHiraganaName($this->string($hiraganaName))?->get('id');
    }

    /**
     * @param  string|null  $katakanaName
     * @return int|null
     */
    public function prefectureIdByKatakanaName(?string $katakanaName): ?int
    {
        return Prefecture::byKatakanaName($this->string($katakanaName))?->get('id');
    }

    /**
     * @param  string|null  $englishName
     * @return int|null
     */
    public function prefectureIdByEnglishName(?string $englishName): ?int
    {
        return Prefecture::byEnglishName($this->string($englishName))?->get('id');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function prefectureNameById(?int $id): ?string
    {
        return Prefecture::byId($id)?->get('name');
    }

    /**
     * @param  string|null  $shortName
     * @return string|null
     */
    public function prefectureNameByShortName(?string $shortName): ?string
    {
        return Prefecture::byShortName($this->string($shortName))?->get('name');
    }

    /**
     * @param  string|null  $hiraganaName
     * @return string|null
     */
    public function prefectureNameByHiraganaName(?string $hiraganaName): ?string
    {
        return Prefecture::byHiraganaName($this->string($hiraganaName))?->get('name');
    }

    /**
     * @param  string|null  $katakanaName
     * @return string|null
     */
    public function prefectureNameByKatakanaName(?string $katakanaName): ?string
    {
        return Prefecture::byKatakanaName($this->string($katakanaName))?->get('name');
    }

    /**
     * @param  string|null  $englishName
     * @return string|null
     */
    public function prefectureNameByEnglishName(?string $englishName): ?string
    {
        return Prefecture::byEnglishName($this->string($englishName))?->get('name');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function prefectureShortNameById(?int $id): ?string
    {
        return Prefecture::byId($id)?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return string|null
     */
    public function prefectureShortNameByName(?string $name): ?string
    {
        return Prefecture::byName($this->string($name))?->get('short_name');
    }

    /**
     * @param  string|null  $hiraganaName
     * @return string|null
     */
    public function prefectureShortNameByHiraganaName(?string $hiraganaName): ?string
    {
        return Prefecture::byHiraganaName($this->string($hiraganaName))?->get('short_name');
    }

    /**
     * @param  string|null  $katakanaName
     * @return string|null
     */
    public function prefectureShortNameByKatakanaName(?string $katakanaName): ?string
    {
        return Prefecture::byKatakanaName($this->string($katakanaName))?->get('short_name');
    }

    /**
     * @param  string|null  $englishName
     * @return string|null
     */
    public function prefectureShortNameByEnglishName(?string $englishName): ?string
    {
        return Prefecture::byEnglishName($this->string($englishName))?->get('short_name');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function prefectureHiraganaNameById(?int $id): ?string
    {
        return Prefecture::byId($id)?->get('hiragana_name');
    }

    /**
     * @param  string|null  $name
     * @return string|null
     */
    public function prefectureHiraganaNameByName(?string $name): ?string
    {
        return Prefecture::byName($this->string($name))?->get('hiragana_name');
    }

    /**
     * @param  string|null  $shortName
     * @return string|null
     */
    public function prefectureHiraganaNameByShortName(?string $shortName): ?string
    {
        return Prefecture::byShortName($this->string($shortName))?->get('hiragana_name');
    }

    /**
     * @param  string|null  $katakanaName
     * @return string|null
     */
    public function prefectureHiraganaNameByKatakanaName(?string $katakanaName): ?string
    {
        return Prefecture::byKatakanaName($this->string($katakanaName))?->get('hiragana_name');
    }

    /**
     * @param  string|null  $englishName
     * @return string|null
     */
    public function prefectureHiraganaNameByEnglishName(?string $englishName): ?string
    {
        return Prefecture::byEnglishName($this->string($englishName))?->get('hiragana_name');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function prefectureKatakanaNameById(?int $id): ?string
    {
        return Prefecture::byId($id)?->get('katakana_name');
    }

    /**
     * @param  string|null  $name
     * @return string|null
     */
    public function prefectureKatakanaNameByName(?string $name): ?string
    {
        return Prefecture::byName($this->string($name))?->get('katakana_name');
    }

    /**
     * @param  string|null  $shortName
     * @return string|null
     */
    public function prefectureKatakanaNameByShortName(?string $shortName): ?string
    {
        return Prefecture::byShortName($this->string($shortName))?->get('katakana_name');
    }

    /**
     * @param  string|null  $hiraganaName
     * @return string|null
     */
    public function prefectureKatakanaNameByHiraganaName(?string $hiraganaName): ?string
    {
        return Prefecture::byHiraganaName($this->string($hiraganaName))?->get('katakana_name');
    }

    /**
     * @param  string|null  $englishName
     * @return string|null
     */
    public function prefectureKatakanaNameByEnglishName(?string $englishName): ?string
    {
        return Prefecture::byEnglishName($this->string($englishName))?->get('katakana_name');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function prefectureEnglishNameById(?int $id): ?string
    {
        return Prefecture::byId($id)?->get('english_name');
    }

    /**
     * @param  string|null  $name
     * @return string|null
     */
    public function prefectureEnglishNameByName(?string $name): ?string
    {
        return Prefecture::byName($this->string($name))?->get('english_name');
    }

    /**
     * @param  string|null  $shortName
     * @return string|null
     */
    public function prefectureEnglishNameByShortName(?string $shortName): ?string
    {
        return Prefecture::byShortName($this->string($shortName))?->get('english_name');
    }

    /**
     * @param  string|null  $hiraganaName
     * @return string|null
     */
    public function prefectureEnglishNameByHiraganaName(?string $hiraganaName): ?string
    {
        return Prefecture::byHiraganaName($this->string($hiraganaName))?->get('english_name');
    }

    /**
     * @param  string|null  $katakanaName
     * @return string|null
     */
    public function prefectureEnglishNameByKatakanaName(?string $katakanaName): ?string
    {
        return Prefecture::byKatakanaName($this->string($katakanaName))?->get('english_name');
    }

    /**
     * @param  string|null  $name
     * @return int|null
     */
    public function stadiumIdByName(?string $name): ?int
    {
        return Stadium::byName($this->string($name))?->get('id');
    }

    /**
     * @param  string|null  $shortName
     * @return int|null
     */
    public function stadiumIdByShortName(?string $shortName): ?int
    {
        return Stadium::byShortName($this->string($shortName))?->get('id');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function stadiumNameById(?int $id): ?string
    {
        return Stadium::byId($id)?->get('name');
    }

    /**
     * @param  string|null  $shortName
     * @return string|null
     */
    public function stadiumNameByShortName(?string $shortName): ?string
    {
        return Stadium::byShortName($this->string($shortName))?->get('name');
    }

    /**
     * @param  int|null  $id
     * @return string|null
     */
    public function stadiumShortNameById(?int $id): ?string
    {
        return Stadium::byId($id)?->get('short_name');
    }

    /**
     * @param  string|null  $name
     * @return string|null
     */
    public function stadiumShortNameByName(?string $name): ?string
    {
        return Stadium::byName($this->string($name))?->get('short_name');
    }
}
