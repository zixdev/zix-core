<?php

namespace Zix\Core\Console\Generators;

use Illuminate\Filesystem\Filesystem;
use Zix\Core\Support\Stub;

class ModuleGenerator extends Generators
{

    /**
     * Generate the module.
     */
    public function generate()
    {
        if (!$this->filesystem->isDirectory(config('modules.paths.modules') . $this->getName())) {
            $this->generateFolders()->generateFiles();

            return $this->console->info("Module {$this->getName()} was successfully created !");
        }

        return $this->console->error("Module [{$this->getName()}] already exist!");
    }

    /**
     * Generate the folders.
     */
    public function generateFolders()
    {
        foreach ($this->getFolders() as $folder) {
            $this->filesystem->makeDirectory($this->getPath($folder), 0755, true);
        }
        return $this;
    }

    /**
     * Generate the files.
     */
    public function generateFiles()
    {
        foreach ($this->getFiles() as $stub => $file) {

            if (!$this->filesystem->isDirectory($this->getPath())) {
                $this->filesystem->makeDirectory($this->getPath(), 0775, true);
            }

            $this->filesystem->put($this->getPath($file), $this->getStubContents($stub));
            $this->console->info("Created : {$this->getPath($file)}");
        }

        return $this;
    }

    public function generateStub($type, $namespace, $name)
    {
        if (!$this->filesystem->isDirectory($this->getPath())) {
            $this->filesystem->makeDirectory($this->getPath(), 0775, true);
        }

        $this->filesystem->put($this->getPath($namespace.$name).'.php', $this->getStubContents($type));
        
    }

    /**
     * Get new Module Path
     * @param string $folder
     * @return string
     */
    public function getPath($folder = '')
    {
        return $this->getConfig('paths.modules') . $this->getName() . '/' . $folder;
    }

    /**
     * Get the list of folders will created.
     *
     * @return array
     */
    public function getFolders()
    {
        return array_values($this->getConfig('paths.generator'));
    }

    /**
     * Get the list of files will created.
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->getConfig('stubs.files');
    }

    /**
     * Get the contents of the specified stub file by given stub name.
     *
     * @param $stub
     *
     * @return Stub
     */
    protected function getStubContents($stub)
    {
        return (new Stub(
            config('modules.paths.modules') . 'Core/Console/Commands/stubs/' . $stub . '.stub',
            $this->getReplacement())
        )->render();
    }


}