<?php
declare(strict_types=1);

namespace vDesk\Packages;

use vDesk\Locale\IPackage;
use vDesk\Package;
use vDesk\Modules\Module\Command;
use vDesk\Modules\Module\Command\Parameter;
use vDesk\Struct\Collections\Observable\Collection;
use vDesk\Struct\Type;
use vDesk\Struct\Extension;

/**
 * Class Packages represents ...
 *
 * @package vDesk\Packages\Packages
 * @author  Kerry <DevelopmentHero@gmail.com>
 * @version 1.0.0
 */
final class Packages extends Package implements IPackage {
    
    /**
     * The name of the Package.
     */
    public const Name = "Packages";
    
    /**
     * The version of the Package.
     */
    public const Version = "1.0.0";
    
    /**
     * The name of the Package.
     */
    public const Vendor = "Kerry <DevelopmentHero@gmail.com>";
    
    /**
     * The name of the Package.
     */
    public const Description = "Package providing functionality for creating setups and creating, installing and uninstalling packages.";
    
    /**
     * The dependencies of the Package.
     */
    public const Dependencies = [
        "Events"   => "1.0.0",
        "Locale"   => "1.0.0",
        "Security" => "1.0.0"
    ];
    
    /**
     * The files and directories of the Package.
     */
    public const Files = [
        self::Client => [
            self::Design => [
                "vDesk/Packages"
            ],
            self::Lib    => [
                "vDesk/Packages.js",
                "vDesk/Packages"
            ]
        ],
        self::Server => [
            self::Modules => [
                "Packages.php"
            ],
            self::Lib     => [
                "vDesk/Package.php",
                "vDesk/Setup.php",
                "vDesk/Package",
                "vDesk/Packages"
            ]
        ]
    ];
    
    /**
     * The translations of the Package.
     */
    public const Locale = [
        "DE" => [
            "Packages"    => [
                "Install"      => "Installieren",
                "Uninstall"    => "Deinstallieren",
                "Packages"     => "Pakete",
                "Package"      => "Paket",
                "Version"      => "Version",
                "Dependencies" => "Abhängigkeiten",
                "Vendor"       => "Herausgeber",
                "Description"  => "Beschreibung"
            ],
            "Permissions" => [
                "InstallPackage"   => "Legt fest ob Mitglieder der Gruppe Pakete installieren können",
                "UninstallPackage" => "Legt fest ob Mitglieder der Gruppe Pakete deinstallieren können"
            ]
        ],
        "EN" => [
            "Packages"    => [
                "Install"      => "Install",
                "Uninstall"    => "Uninstall",
                "Packages"     => "Packages",
                "Package"      => "Package",
                "Version"      => "Version",
                "Dependencies" => "Dependencies",
                "Vendor"       => "Vendor",
                "Description"  => "Description"
            ],
            "Permissions" => [
                "InstallPackage"   => "Determines whether members of the group are allowed to install Packages",
                "UninstallPackage" => "Determines whether members of the group are allowed to uninstall Packages"
            ]
        ]
    ];
    
    /**
     * @inheritDoc
     */
    public static function Install(\Phar $Phar, string $Path): void {
        
        //Install Module.
        /** @var \Modules\Packages $Packages */
        $Packages = \vDesk\Modules::Packages();
        $Packages->Commands->Add(
            new Command(
                null,
                $Packages,
                "CreateSetup",
                true,
                false,
                null,
                new Collection([
                    new Parameter(null, null, "Path", Type::String, true, true),
                    new Parameter(null, null, "Exclude", Type::Array, true, true)
                ])
            )
        );
        $Packages->Commands->Add(
            new Command(
                null,
                $Packages,
                "GetPackages",
                true,
                false
            )
        );
        $Packages->Commands->Add(
            new Command(
                null,
                $Packages,
                "CreatePackage",
                true,
                false,
                null,
                new Collection([
                    new Parameter(null, null, "Package", Type::String, false, false),
                    new Parameter(null, null, "Path", Type::String, true, true)
                ])
            )
        );
        $Packages->Commands->Add(
            new Command(
                null,
                $Packages,
                "InstallPackage",
                true,
                true,
                null,
                new Collection([new Parameter(null, null, "Package", Extension\Type::File, false, true)])
            )
        );
        $Packages->Commands->Add(
            new Command(
                null,
                $Packages,
                "UninstallPackage",
                true,
                true,
                null,
                new Collection([new Parameter(null, null, "Package", Type::String, false, true)])
            )
        );
        $Packages->Save();
        
        //Create permissions.
        /** @var \Modules\Security $Security */
        $Security = \vDesk\Modules::Security();
        $Security::CreatePermission("InstallPackage", false);
        $Security::CreatePermission("UninstallPackage", false);
        
        //Extract files.
        static::Deploy($Phar, $Path);
    }
    
    /**
     * @inheritDoc
     */
    public static function Uninstall(string $Path): void {
        
        //Uninstall Module.
        /** @var \Modules\Packages $Packages */
        $Packages = \vDesk\Modules::Packages();
        $Packages->Delete();
        
        //Delete permissions.
        /** @var \Modules\Security $Security */
        $Security = \vDesk\Modules::Security();
        $Security::DeletePermission("InstallPackage");
        $Security::DeletePermission("UninstallPackage");
        
        //Delete files.
        static::Undeploy();
        
    }
}