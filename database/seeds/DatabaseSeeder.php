<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(SocietiesTableSeeder::class);
        $this->call(BlocksTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(MembershipPlansTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PropertyPurposeTableSeeder::class);
        $this->call(PropertyTypeTableSeeder::class);
        $this->call(PropertySubTypeTable::class);
        $this->call(LandUnitTable::class);
        $this->call(PropertyStatusTable::class);
        $this->call(HtmlStructuresTableSeeder::class);
        $this->call(FeatureSectionsTableSeeder::class);
        $this->call(PropertyFeaturesTableSeeder::class);
        $this->call(PropertySubTypeAssignedFeaturesTableSeeder::class);
        $this->call(ValidationRulesTableSeeder::class);
        $this->call(AppMessagesTableSeeder::class);
        $this->call(ValidationErrorMessagesTableSeeder::class);
        $this->call(AssignedFeatureValidationsTableSeeder::class);
        //$this->call(PropertyDocumentTableSeeder::class);
    }
}
