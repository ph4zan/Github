<?php

namespace App;


class Developer extends Worker
{
    use HasRest;

    protected string $position;

    private array $attributes;

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function work()
    {
        print_r('im developing');
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    // public function __destruct()
    // {
    // print_r('11111');
    // }

    public function __call(string $name, array $arguments)
    {
        print_r($arguments);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        print_r($name);
    }

    public function __get(string $name)
    {
        if(isset($this->attributes[$name])) {
            return $name;
        }
        return null;
    }

    public function __set(string $name, $value): void
    {
        $this->attributes[$name] = $value;
        print_r($value);
    }

    public function __isset(string $name): bool
    {
        return true;
    }

    public function __unset(string $name): void
    {
        print_r('123');
    }

    public function __sleep(): array
    {
        print_r('222222222');
        return [];
    }

    public function __wakeup(): void
    {

    } 

    public function __serialize(): array
    {
        return [
            'dqwkegnq' => 'ggrrw'
        ];
    }

    public function __unserialize(array $data): void
    {
        var_dump($data);
    }

    public function __invoke()
    {
        print_r('123456789');
    }

    public function __clone(): void
    {
        print_r('eefwmxjw');
    }

    public function __debugInfo(): ?array
    {
        return [
            'key' => 'val'
        ];
    }
}