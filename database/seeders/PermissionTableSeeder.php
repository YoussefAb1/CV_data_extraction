<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([

            [
                'name' => 'Menu Utilisateur',
                'group_name' => 'Utilisateur',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Lister Utilisateurs',
                'group_name' => 'Utilisateur',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Créer Utilisateur',
                'group_name' => 'Utilisateur',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Editer Utilisateur',
                'group_name' => 'Utilisateur',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supprimer Utilisateur',
                'group_name' => 'Utilisateur',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Menu Résidence',
                'group_name' => 'Résidence',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Lister Résidences',
                'group_name' => 'Résidence',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Créer Résidence',
                'group_name' => 'Résidence',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Editer Résidence',
                'group_name' => 'Résidence',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supprimer Résidence',
                'group_name' => 'Résidence',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Menu Immeuble',
                'group_name' => 'Immeuble',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Lister Immeubles',
                'group_name' => 'Immeuble',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Créer Immeuble',
                'group_name' => 'Immeuble',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Editer Immeuble',
                'group_name' => 'Immeuble',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supprimer Immeuble',
                'group_name' => 'Immeuble',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Menu Appartement',
                'group_name' => 'Appartement',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Lister Appartements',
                'group_name' => 'Appartement',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Créer Appartement',
                'group_name' => 'Appartement',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Editer Appartement',
                'group_name' => 'Appartement',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supprimer Appartement',
                'group_name' => 'Appartement',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Menu Charge',
                'group_name' => 'Charge',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Lister Charges',
                'group_name' => 'Charge',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Créer Charge',
                'group_name' => 'Charge',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Editer Charge',
                'group_name' => 'Charge',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supprimer Charge',
                'group_name' => 'Charge',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Menu Cotisation',
                'group_name' => 'Cotisation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Lister Cotisations',
                'group_name' => 'Cotisation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Créer Cotisation',
                'group_name' => 'Cotisation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Editer Cotisation',
                'group_name' => 'Cotisation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supprimer Cotisation',
                'group_name' => 'Cotisation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Menu Paiement',
                'group_name' => 'Paiement',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Lister Paiements',
                'group_name' => 'Paiement',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Créer Paiement',
                'group_name' => 'Paiement',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Editer Paiement',
                'group_name' => 'Paiement',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supprimer Paiement',
                'group_name' => 'Paiement',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Menu Facture',
                'group_name' => 'Facture',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Lister Factures',
                'group_name' => 'Facture',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Créer Facture',
                'group_name' => 'Facture',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Editer Facture',
                'group_name' => 'Facture',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supprimer Facture',
                'group_name' => 'Facture',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Menu Role',
                'group_name' => 'Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Lister Roles',
                'group_name' => 'Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Créer Role',
                'group_name' => 'Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Editer Role',
                'group_name' => 'Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supprimer Role',
                'group_name' => 'Role',
                'guard_name' => 'web',
            ],

        ]);
    }
}
