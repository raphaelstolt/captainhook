<?php
/**
 * This file is part of CaptainHook.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace sebastianfeldmann\CaptainHook\Storage;

/**
 * Class File
 *
 * @package CaptainHook
 * @author  Sebastian Feldmann <sf@sebastian-feldmann.info>
 * @link    https://github.com/sebastianfeldmann/captainhook
 * @since   Class available since Release 0.9.0
 */
class File
{
    /**
     * Path to file
     *
     * @var string
     */
    protected $path;

    /**
     * File constructor.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Path getter.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Checks whether the file exists.
     *
     * @return bool
     */
    public function exists()
    {
        return is_file($this->path);
    }

    /**
     * Reads json file.
     *
     * @throws \RuntimeException
     * @return string
     */
    public function read()
    {
        if (!file_exists($this->path)) {
            throw new \RuntimeException('Could not read ' . $this->path);
        }
        return file_get_contents($this->path);
    }

    /**
     * Writes file.
     *
     * @param  string $content
     * @throws \RuntimeException
     */
    public function write($content)
    {
        $this->checkFile();
        $this->checkDir();

        file_put_contents($this->path, $content);
    }

    /**
     * Check if file exists and isn't writable
     *
     * @return void
     * @throws \RuntimeException
     */
    private function checkFile()
    {
        if (file_exists($this->path) && !is_writable($this->path)) {
            throw new \RuntimeException('File exists and is not writable');
        }
    }

    /**
     * Create directory if necessary
     *
     * @throws \RuntimeException
     */
    private function checkDir()
    {
        $dir = dirname($this->path);
        if (!is_dir($dir)) {
            if (file_exists($dir)) {
                throw new \RuntimeException($dir . ' exists and is not a directory.');
            }
            if (!@mkdir($dir, 0755, true)) {
                throw new \RuntimeException($dir . ' does not exist and could not be created.');
            }
        }
    }
}
