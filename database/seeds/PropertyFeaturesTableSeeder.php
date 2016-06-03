<?php

use Illuminate\Database\Seeder;
class PropertyFeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_features')->insert([
            [
                'feature_section_id' => 1,
                'feature' => 'Built in year',
                'input_name' => 'build_in_year',
                'html_structure_id' => 1,
                'possible_values' => '',
                'priority' =>0
             ],
            [
                'feature_section_id' =>1,
                'feature' => 'View',
                'input_name' => 'view',
                'html_structure_id' =>1,
                'possible_values' =>'',
                'priority' => 0
             ],
            [
                'feature_section_id' => 1,
                'feature' => 'Parking Spaces',
                'input_name' => 'parking_spaces',
                'html_structure_id' => 1,
                'possible_values' => '',
                'priority' =>0
             ],
            [
                'feature_section_id' => 1,
                'feature' => 'Double Glazed Windows',
                'input_name' => 'double_glazed_windows',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' =>0
             ],
            [
                'feature_section_id' => 1,
                'feature' => 'Central Air Conditioning',
                'input_name' => 'central_air_conditioning',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' => 1,
                'feature' => 'Central Heating',
                'input_name' => 'central_heating',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority'=>0
             ],
            [
                'feature_section_id' => 1,
                'feature' => 'Flooring',
                'input_name' => 'flooring',
                'html_structure_id' => 3,
                'possible_values' => 'Tiles,Marble,Wooden,Chip,Cement,Other',
                'priority' => 0
             ],

            [
                'feature_section_id' => 1,
                'feature' => 'Electricity Backup',
                'input_name' => 'electricity_backup',
                'html_structure_id' => 3,
                'possible_values' => 'None,Generator,Ups,Solar,Other',
                'priority' => 0
             ],
            [
                'feature_section_id' => 1,
                'feature' => 'Waste Disposal',
                'input_name' => 'waste_disposal',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' => 1,
                'feature' => 'Total Number of Floors',
                'input_name' => 'total_number_of_floors',
                'html_structure_id' => 1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>1,
                'feature' => 'Other Main Features',
                'input_name' => 'other_main_features',
                'html_structure_id' => 1,
                'possible_values' =>'',
                'priority' => 0
             ],
            [
                'feature_section_id' =>1,
                'feature' => 'Furnished',
                'input_name' => 'furnished',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>2,
                'feature' => 'Broadband Internet Access',
                'input_name' => 'broadband_internet_access',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>2,
                'feature' => 'Satellite or Cable TV Ready',
                'input_name' => 'satellite_or_cable_tV_ready',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>2,
                'feature' => 'Intercom',
                'input_name' => 'intercom',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>2,
                'feature' => 'Other Business and Communication Facilities ',
                'input_name' => 'other_business_and_communication_facilities ',
                'html_structure_id' =>1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>3,
                'feature' => 'Nearby Schools',
                'input_name' => 'nearby_schools',
                'html_structure_id' => 1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>3,
                'feature' => 'Nearby Hospitals',
                'input_name' => 'nearby_hospitals',
                'html_structure_id' => 1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>3,
                'feature' => 'Nearby Shopping Malls',
                'input_name' => 'nearby_shopping_malls',
                'html_structure_id' =>1 ,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>3,
                'feature' => 'Nearby Restaurants',
                'input_name' => 'nearby_restaurants',
                'html_structure_id' =>1 ,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>3,
                'feature' => 'Distance From Airport (kms)',
                'input_name' => 'distance_from_airport_kms',
                'html_structure_id' =>1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>3,
                'feature' => 'Nearby Public Transport Service',
                'input_name' => 'nearby_public_transport_service',
                'html_structure_id' =>1 ,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>3,
                'feature' => 'Other Nearby Places',
                'input_name' => 'other_nearby_places',
                'html_structure_id' => 1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Number of Bedrooms',
                'input_name' => 'number_of_bedrooms',
                'html_structure_id' =>1 ,
                'possible_values' => '',
                'priority' => 0
            ],
            [
                'feature_section_id' =>4,
                'feature' => 'Number of Bathrooms',
                'input_name' => 'number_of_bathrooms',
                'html_structure_id' => 1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Number of Servant Quarters',
                'input_name' => 'number_of_servant_quarters',
                'html_structure_id' => 1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Drawing Room',
                'input_name' => 'drawing_room',
                'html_structure_id' =>6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Dining Room',
                'input_name' => 'dining_room',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Number of Kitchens',
                'input_name' => 'number_of_kitchens',
                'html_structure_id' =>1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Study Room',
                'input_name' => 'study_room',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Prayer Room',
                'input_name' => 'prayer_room',
                'html_structure_id' =>6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Powder Room',
                'input_name' => 'powder_room',
                'html_structure_id' =>6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Gym Room',
                'input_name' => 'gym_room',
                'html_structure_id' =>6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Number of Store Rooms',
                'input_name' => 'number_of_store_rooms',
                'html_structure_id' => 1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Steaming Room',
                'input_name' => 'steaming_room',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Lounge or Sitting Room',
                'input_name' => 'lounge_or_sitting_room',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Laundry Room',
                'input_name' => 'laundry_room',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>4,
                'feature' => 'Other Rooms',
                'input_name' => 'other_rooms',
                'html_structure_id' =>1 ,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>5,
                'feature' => 'Lawn or Garden',
                'input_name' => 'lawn_or_garden',
                'html_structure_id' =>6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>5,
                'feature' => 'Swimming Pool',
                'input_name' => 'swimming_pool',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>5,
                'feature' => 'Sauna',
                'input_name' => 'sauna',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>5,
                'feature' => 'Jacuzzi',
                'input_name' => 'jacuzzi',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>5,
                'feature' => 'Other Healthcare and Recreation Facilities',
                'input_name' => 'other_healthcare_and_recreation_facilities',
                'html_structure_id' => 1,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>6,
                'feature' => 'Maintenance Staff',
                'input_name' => 'maintenance_staff',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>6,
                'feature' => 'Security Staff',
                'input_name' => 'security_staff',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>6,
                'feature' => 'Facilities for Disabled',
                'input_name' => 'facilities_for_disabled',
                'html_structure_id' => 6,
                'possible_values' => 1,
                'priority' => 0
             ],
            [
                'feature_section_id' =>6,
                'feature' => 'Other Facilities',
                'input_name' => 'other_facilities',
                'html_structure_id' =>1 ,
                'possible_values' => '',
                'priority' => 0
             ],
            [
                'feature_section_id' =>7,
                'feature' => 'Corner',
                'input_name' => 'corner',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],
            [
                'feature_section_id' =>7,
                'feature' => 'Park Facing',
                'input_name' => 'Park_Facing',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],
            [
                'feature_section_id' =>7,
                'feature' => 'Disputed',
                'input_name' => 'disputed',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],
            [
                'feature_section_id' =>7,
                'feature' => 'File',
                'input_name' => 'file',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],
            [
                'feature_section_id' =>7,
                'feature' => 'Balloted',
                'input_name' => 'balloted',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],
            [
                'feature_section_id' =>7,
                'feature' => 'Sewerage',
                'input_name' => 'sewerage',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],
            [
                'feature_section_id' =>7,
                'feature' => 'Electricity',
                'input_name' => 'electricity',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],
            [
                'feature_section_id' =>7,
                'feature' => 'Water Supply',
                'input_name' => 'water_supply',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],
            [
                'feature_section_id' =>7,
                'feature' => 'Sui Gas',
                'input_name' => 'sui_gas',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],
            [
                'feature_section_id' =>7,
                'feature' => 'Boundary Wall',
                'input_name' => 'boundary_wall',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],
            [
                'feature_section_id' =>7,
                'feature' => 'Other Plot Features',
                'input_name' => 'other_plot_features',
                'html_structure_id' =>6 ,
                'possible_values' => 1,
                'priority' => 0
            ],

        ]);
    }
}
