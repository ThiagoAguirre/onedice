<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SystemsFixture
 */
class SystemsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'slug' => 'Lorem ipsum dolor sit amet',
                'is_active' => 1,
                'created' => 1769043633,
                'modified' => 1769043633,
            ],
        ];
        parent::init();
    }
}
