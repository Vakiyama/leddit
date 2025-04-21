{
    description = "Next.js Flake";

    inputs = {
        nixpkgs.url = "github:NixOS/nixpkgs/nixos-unstable";
    };

    outputs = { self, nixpkgs, flake-utils }:
        flake-utils.lib.eachDefaultSystem ( system:
        let
            pkgs = import nixpkgs { inherit system; };
            php = pkgs.php.withExtensions ({ enabled, all }: enabled ++ [ all.xmlreader ]);
        in with pkgs; {
            devShell = mkShell { 
                buildInputs = [
                  php
                  php84Packages.composer
                  laravel
                  php84Extensions.xmlreader
                  bun
                ];
            };
      }
    );
}
