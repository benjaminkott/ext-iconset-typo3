<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/iconset-typo3.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\IconsetTypo3\Icons;

use BK2K\BootstrapPackage\Icons\IconList;
use BK2K\BootstrapPackage\Icons\IconProviderInterface;
use BK2K\BootstrapPackage\Icons\SvgIcon;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class IconProvider implements IconProviderInterface
{
    public function getIdentifier(): string
    {
        return 'iconset_typo3';
    }

    public function getName(): string
    {
        return 'TYPO3';
    }

    public function supports(string $identifier): bool
    {
        return 'iconset_typo3' === $identifier;
    }

    public function getIconList(): IconList
    {
        $icons = new IconList();
        $categories = [
            'actions',
            'apps',
            'content',
            'form',
            'mimetypes',
        ];

        $iconsBaseDirectory = 'EXT:iconset_typo3/Resources/Public/Contrib/typo3-icons/';
        $iconsDefinitionFile = 'EXT:iconset_typo3/Resources/Public/Contrib/typo3-icons/icons.json';
        $data = json_decode((string) GeneralUtility::getUrl(GeneralUtility::getFileAbsFileName($iconsDefinitionFile)), true, 512, JSON_THROW_ON_ERROR);
        foreach ($data['icons'] as $icon) {
            if (!in_array($icon['category'], $categories, true)) {
                continue;
            }
            $icons->addIcon(
                (new SvgIcon())
                    ->setSrc($iconsBaseDirectory . $icon['svg'])
                    ->setIdentifier($icon['identifier'])
                    ->setName($icon['identifier'])
                    ->setPreviewImage($iconsBaseDirectory . $icon['svg'])
            );
        }

        return $icons;
    }
}
