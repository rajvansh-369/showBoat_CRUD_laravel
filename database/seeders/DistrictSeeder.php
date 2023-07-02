<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = array(
            "Andhra Pradesh" => array(
                "Anantapur",
                "Chittoor",
                "East Godavari",
                "Guntur",
                "Kadapa",
                "Krishna",
                "Kurnool",
                "Nellore",
                "Prakasam",
                "Srikakulam",
                "Visakhapatnam",
                "Vizianagaram",
                "West Godavari"
            ),
            "Bihar" => array(
                "Araria",
                "Aurangabad",
                "Banka",
                "Begusarai",
                "Bhagalpur",
                "Bhojpur",
                "Buxar",
                "Darbhanga",
                "Gaya",
                "Gopalganj",
                "Jamui",
                "Jehanabad",
                "Kaimur",
                "Katihar",
                "Khagaria",
                "Kishanganj",
                "Lakhisarai",
                "Madhepura",
                "Madhubani",
                "Munger",
                "Muzaffarpur",
                "Nalanda",
                "Nawada",
                "Patna",
                "Purnia",
                "Rohtas",
                "Saharsa",
                "Samastipur",
                "Saran",
                "Sheikhpura",
                "Sheohar",
                "Sitamarhi",
                "Siwan",
                "Supaul",
                "Vaishali",
                "West Champaran"
            ),
            "Delhi" => array(
                "Central Delhi",
                "East Delhi",
                "New Delhi",
                "North Delhi",
                "North East Delhi",
                "North West Delhi",
                "South Delhi",
                "South East Delhi",
                "South West Delhi",
                "West Delhi"
            ),
            "Gujarat" => array(
                "Ahmedabad",
                "Amreli",
                "Anand",
                "Aravalli",
                "Banaskantha",
                "Bharuch",
                "Bhavnagar",
                "Botad",
                "Chhota Udaipur",
                "Dahod",
                "Dang",
                "Devbhoomi Dwarka",
                "Gandhinagar",
                "Gir Somnath",
                "Jamnagar",
                "Junagadh",
                "Kheda",
                "Kutch",
                "Mahisagar",
                "Mehsana",
                "Morbi",
                "Narmada",
                "Navsari",
                "Panchmahal",
                "Patan",
                "Porbandar",
                "Rajkot",
                "Sabarkantha",
                "Surat",
                "Surendranagar",
                "Tapi",
                "Vadodara",
                "Valsad"
            ),
            "Karnataka" => array(
                "Bagalkot",
                "Ballari",
                "Belagavi",
                "Bengaluru Rural",
                "Bengaluru Urban",
                "Bidar",
                "Chamarajanagar",
                "Chikkaballapur",
                "Chikkamagaluru",
                "Chitradurga",
                "Dakshina Kannada",
                "Davanagere",
                "Dharwad",
                "Gadag",
                "Hassan",
                "Haveri",
                "Kalaburagi",
                "Kodagu",
                "Kolar",
                "Koppal",
                "Mandya",
                "Mysuru",
                "Raichur",
                "Ramanagara",
                "Shivamogga",
                "Tumakuru",
                "Udupi",
                "Uttara Kannada",
                "Vijayapura",
                "Yadgir"
            )
            // Add more states and districts as needed
        );


        foreach ($districts as $key => $state) {

            foreach ($state as $districtName) {

                $getStateId = State::where('name', 'like', '%' . $key . '%')->select('id')->first();

                if ($getStateId) {
                    District::updateOrCreate(
                        ['name' => $districtName],
                        ['state_id' => $getStateId->id]
                    );
                }
            }
        }
    }
}
