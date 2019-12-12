<?php /** @noinspection PhpUnused */

namespace Vendor\Orm\Model;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\FileTable;
use Bitrix\Main\IO\FileNotFoundException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Vendor\Interfaces\Orm\Model\FileInterface;

/**
 * Class File
 *
 * @package Vendor\Orm\Model
 */
class File implements FileInterface
{
    /**
     * @var array
     */
    protected $fields;

    /**
     * @var string
     */
    protected $src;

    /**
     * File constructor.
     *
     * @param array $fields
     */
    public function __construct(array $fields = [])
    {
        if ($fields['src']) {
            $this->setSrc($fields['src']);
        } else {
            if ($fields['SRC']) {
                $this->setSrc($fields['SRC']);
            }
        }
        $this->fields = $fields;
    }

    /**
     * @param string $primary
     *
     * @return static
     * @throws FileNotFoundException
     */
    public static function createFromPrimary($primary): FileInterface
    {
        try {
            $fields = FileTable::getById($primary)->fetch();
        } catch (ObjectPropertyException|ArgumentException|SystemException $e) {
            throw new FileNotFoundException($e->getMessage(), $e->getCode(), $e);
        }
        if (!$fields) {
            throw new FileNotFoundException(sprintf('File with id %s is not found', $primary));
        }
        return new static($fields);
    }

    /**
     * @return string
     */
    public function getSrc(): string
    {
        if ($this->src === null) {
            try {
                $src = sprintf('/%s/%s/%s',
                    Option::get('main', 'upload_dir', 'upload'),
                    $this->getSubDir(),
                    $this->getFileName()
                );
                $this->setSrc($src);
            } catch (ArgumentNullException|ArgumentOutOfRangeException $e) {
            }
        }
        return $this->src;
    }

    /**
     * @param string $src
     *
     * @return static
     */
    protected function setSrc($src): self
    {
        $this->src = $src;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubDir(): string
    {
        return (string)$this->fields['SUBDIR'];
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return (string)$this->fields['FILE_NAME'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->fields['ID'];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getSrc();
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
