<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Zed\Propel\Business\Model;

use Spryker\Zed\Propel\Business\Model\PropelSchemaMerger;
use Symfony\Component\Finder\SplFileInfo;

/**
 * @group Spryker
 * @group Zed
 * @group Propel
 * @group Business
 * @group PropelSchemaMerger
 */
class PropelSchemaMergerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return string
     */
    private function getFixtureDirectory()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'Fixtures' . DIRECTORY_SEPARATOR . 'PropelSchemaMerger';
    }

    /**
     * @return void
     */
    public function testMergeTwoSchemaFilesMustReturnStringWithMergedContent()
    {
        $projectFile = new SplFileInfo(
            $this->getFixtureDirectory() . DIRECTORY_SEPARATOR . 'Project' . DIRECTORY_SEPARATOR . 'foo_bar.schema.xml',
            '',
            ''
        );
        $vendorFile = new SplFileInfo(
            $this->getFixtureDirectory() . DIRECTORY_SEPARATOR . 'Vendor' . DIRECTORY_SEPARATOR . 'foo_bar.schema.xml',
            '',
            ''
        );

        $filesToMerge = [];
        $filesToMerge['foo_bar.schema.xml'][] = $projectFile;
        $filesToMerge['foo_bar.schema.xml'][] = $vendorFile;

        $merger = new PropelSchemaMerger();
        $content = $merger->merge($filesToMerge['foo_bar.schema.xml']);

        $expected = file_get_contents($this->getFixtureDirectory() . DIRECTORY_SEPARATOR . 'expected.merged.schema.xml');
        $this->assertSame($expected, $content);
    }

}
