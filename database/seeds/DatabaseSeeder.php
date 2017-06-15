<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Deal;
use App\Models\Customer;
use App\Models\DealCriteria;
use App\Models\DealOffer;
use App\Models\CustomerOffer;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('JobCornerSeeder');
        $this->command->info('JobCorner app seeds finished.');
    }
}

class JobCornerSeeder extends Seeder
{

    public function run()
    {

        // clear database
        DB::table('customer_offers')->delete();
        DB::table('customers')->delete();
        DB::table('deal_criteria')->delete();
        DB::table('deal_offer')->delete();
        DB::table('deals')->delete();
        DB::table('products')->delete();

        // seed products
        $classic = Product::create(array(
            'name'         => 'classic',
            'description'  => 'basic level of advertisement',
            'allowed_char' => 765,
            'price' => 269.99,
        ));

        $standout = Product::create(array(
            'name'         => 'standout',
            'description'  => 'use company logo and longer presentation text',
            'allowed_char' => 1275,
            'price' => 322.99,
        ));

        $premium = Product::create(array(
            'name'         => 'premium',
            'description'  => 'standout + and displays at the top',
            'allowed_char' => 1275,
            'price' => 394.99,
        ));

        $this->command->info('Created products data');
        
        // seed customers
        $unilever = Customer::create(array(
            'name' => 'UNILEVER',
            'contact_number' => 1234,
            'priviledged' => 1,
        ));
        
        $apple = Customer::create(array(
            'name' => 'APPLE',
            'contact_number' => 5678,
            'priviledged' => 1,
        ));
        
        $nike = Customer::create(array(
            'name' => 'NIKE',
            'contact_number' => 7654,
            'priviledged' => 1,
        ));

        $ford = Customer::create(array(
            'name' => 'FORD',
            'contact_number' => 7654,
            'priviledged' => 1,
        ));

        $nokia = Customer::create(array(
            'name' => 'NOKIA',
            'contact_number' => 7654,
            'priviledged' => 0,
        ));

        $this->command->info('Created customer data');

        // seed users
        $admin_user = User::create(array(
            'name'         => 'Admin',
            'email'  => 'admin@corner.com',
            'password' => 'test123!',
            'customer_id' => 0,
        ));

        $apple_user = User::create(array(
            'name'         => 'Steve Jobs',
            'email'  => 'user@apple.com',
            'password' => 'test123!',
            'customer_id' => $apple->id,
        ));

        $ford_user = User::create(array(
            'name'         => 'Henry Ford',
            'email'  => 'user@ford.com',
            'password' => 'test123!',
            'customer_id' => $ford->id,
        ));

        $nike_user = User::create(array(
            'name'         => 'Phil Knight',
            'email'  => 'user@nike.com',
            'password' => 'test123!',
            'customer_id' => $nike->id,
        ));

        $unilever_user = User::create(array(
            'name'         => 'Paul Polman',
            'email'  => 'user@unilever.com',
            'password' => 'test123!',
            'customer_id' => $unilever->id,
        ));

        $nokia_user = User::create(array(
            'name'         => 'Stephen Elop',
            'email'  => 'user@nokia.com',
            'password' => 'test123!',
            'customer_id' => $nokia->id,
        ));

        $this->command->info('Created login users data');
        
        // seed deals
        $deal1 = Deal::create(array(
            'name' => 'Classic ad 3 for 2',
        ));
        
        $deal2 = Deal::create(array(
            'name' => 'Standout ad discount',
        ));

        $deal3 = Deal::create(array(
            'name' => 'Premium ad discount',
        ));
        
        $deal4 = Deal::create(array(
            'name' => 'Classic add 5 for 4',
        ));

        $deal5 = Deal::create(array(
            'name' => 'Standout ad discount',
        ));
        
        $deal6 = Deal::create(array(
            'name' => 'Premium ad discount',
        ));

        $deal7 = Deal::create(array(
            'name' => 'Buy 1 classic, 1 standout free premium',
        ));

        $this->command->info('Created deals data');

        // seed deal criteria
        $deal1_criteria = DealCriteria::create(array(
            'deal_id' => $deal1->id,
            'product_id' => $classic->id,
            'quantity' => 2,
            'condition' => 'every',
        ));

        $deal2_criteria = DealCriteria::create(array(
            'deal_id' => $deal2->id,
            'product_id' => $standout->id,
            'quantity' => 0,
            'condition' => null,
        ));

        $deal3_criteria = DealCriteria::create(array(
            'deal_id' => $deal3->id,
            'product_id' => $premium->id,
            'quantity' => 4,
            'condition' => 'more',
        ));

        $deal4_criteria = DealCriteria::create(array(
            'deal_id' => $deal4->id,
            'product_id' => $classic->id,
            'quantity' => 4,
            'condition' => 'more',
        ));

        $deal5_criteria = DealCriteria::create(array(
            'deal_id' => $deal5->id,
            'product_id' => $standout->id,
            'quantity' => 0,
            'condition' => null,
        ));

        $deal6_criteria = DealCriteria::create(array(
            'deal_id' => $deal6->id,
            'product_id' => $premium->id,
            'quantity' => 3,
            'condition' => 'more',
        ));

        $deal7a_criteria = DealCriteria::create(array(
            'deal_id' => $deal7->id,
            'product_id' => $classic->id,
            'quantity' => 1,
            'condition' => null,
        ));

        $deal7b_criteria = DealCriteria::create(array(
            'deal_id' => $deal7->id,
            'product_id' => $standout->id,
            'quantity' => 1,
            'condition' => null,
        ));

        $this->command->info('Created deal_criteria data');

        // seed deal offer
        $deal1_offer = DealOffer::create(array(
            'deal_id' => $deal1->id,
            'product_id' => $classic->id,
            'free_product_quantity' => 1,
            'discounted_price' => null,
        ));

        $deal2_offer = DealOffer::create(array(
            'deal_id' => $deal2->id,
            'product_id' => $standout->id,
            'free_product_quantity' => 0,
            'discounted_price' => 299.99,
        ));

        $deal3_offer = DealOffer::create(array(
            'deal_id' => $deal3->id,
            'product_id' => $premium->id,
            'free_product_quantity' => 0,
            'discounted_price' => 379.99,
        ));

        $deal4_offer = DealOffer::create(array(
            'deal_id' => $deal4->id,
            'product_id' => $classic->id,
            'free_product_quantity' => 1,
            'discounted_price' => null,
        ));

        $deal5_offer = DealOffer::create(array(
            'deal_id' => $deal5->id,
            'product_id' => $standout->id,
            'free_product_quantity' => 0,
            'discounted_price' => 309.99,
        ));

        $deal6_offer = DealOffer::create(array(
            'deal_id' => $deal6->id,
            'product_id' => $premium->id,
            'free_product_quantity' => 0,
            'discounted_price' => 389.99,
        ));

        $deal7_offer = DealOffer::create(array(
            'deal_id' => $deal7->id,
            'product_id' => $premium->id,
            'free_product_quantity' => 1,
            'discounted_price' => null,
        ));

        $this->command->info('Created deal_offer data');

        // seed customer offer
        $unilever_offer = CustomerOffer::create(array(
            'customer_id' => $unilever->id,
            'deal_id' => $deal1->id,
        ));

        $apple_offer = CustomerOffer::create(array(
            'customer_id' => $apple->id,
            'deal_id' => $deal2->id,
        ));

        $nike_offer = CustomerOffer::create(array(
            'customer_id' => $nike->id,
            'deal_id' => $deal3->id,
        ));

        $ford_offer1 = CustomerOffer::create(array(
            'customer_id' => $ford->id,
            'deal_id' => $deal4->id,
        ));

        $ford_offer2 = CustomerOffer::create(array(
            'customer_id' => $ford->id,
            'deal_id' => $deal5_offer->id,
        ));

        $ford_offer3 = CustomerOffer::create(array(
            'customer_id' => $ford->id,
            'deal_id' => $deal6_offer->id,
        ));

        $this->command->info('Created customer_offer data');
        
        //reference for linking tables
        /* // seed our fish table ------------------------
        // our fish wont have names... because theyre going to be eaten

        // we will use the variables we used to create the bears to get their id

        Fish::create(array(
            'weight'  => 5,
            'bear_id' => $bearLawly->id
        ));
        Fish::create(array(
            'weight'  => 12,
            'bear_id' => $bearCerms->id
        ));
        Fish::create(array(
            'weight'  => 4,
            'bear_id' => $bearAdobot->id
        ));

        $this->command->info('They are eating fish!');

        // seed our trees table ---------------------
        Tree::create(array(
            'type'    => 'Redwood',
            'age'     => 500,
            'bear_id' => $bearLawly->id
        ));
        Tree::create(array(
            'type'    => 'Oak',
            'age'     => 400,
            'bear_id' => $bearLawly->id
        ));

        $this->command->info('Climb bears! Be free!');

        // seed our picnics table ---------------------

        // we will create one picnic and apply all bears to this one picnic
        $picnicYellowstone = Picnic::create(array(
            'name'        => 'Yellowstone',
            'taste_level' => 6
        ));
        $picnicGrandCanyon = Picnic::create(array(
            'name'        => 'Grand Canyon',
            'taste_level' => 5
        ));

        // link our bears to picnics ---------------------
        // for our purposes we'll just add all bears to both picnics for our many to many relationship
        $bearLawly->picnics()->attach($picnicYellowstone->id);
        $bearLawly->picnics()->attach($picnicGrandCanyon->id);

        $bearCerms->picnics()->attach($picnicYellowstone->id);
        $bearCerms->picnics()->attach($picnicGrandCanyon->id);

        $bearAdobot->picnics()->attach($picnicYellowstone->id);
        $bearAdobot->picnics()->attach($picnicGrandCanyon->id);

        $this->command->info('They are terrorizing picnics!'); */

    }
}
