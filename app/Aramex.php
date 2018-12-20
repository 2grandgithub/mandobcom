<?php

namespace App;
use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Model;

class Aramex // extends Model
{
      private $Location_SoapClient;

      public function Location_SoapClient()
      {
          $this->Location_SoapClient = new \SoapClient(public_path('aramex/Location-API -WSDL.wsdl'));
      }

      public function LocationCountriesFetching()
      {
          $this->Location_SoapClient();
          $params = array(
            'ClientInfo' => array(
                          'AccountCountryCode'		=> 'JO',
                          'AccountEntity'		 	=> 'AMM',
                          'AccountNumber'		 	=> '20016',
                          'AccountPin'		 	=> '331421',
                          'UserName'			=> 'testingapi@aramex.com',
                          'Password'		 	=> 'R123456789$r',
                          'Version'		 	=> 'v1.0',
                          'Source' 			=> NULL
                        ),

            'Transaction' => array(
                          'Reference1'			=> '001',
                          'Reference2'			=> '002',
                          'Reference3'			=> '003',
                          'Reference4'			=> '004',
                          'Reference5'			=> '005'
                        ),
            );

          // calling the method and printing results
          try {
            $auth_call = $this->Location_SoapClient->FetchCountries($params);

            // echo '<pre>';
            // print_r($auth_call);
            return json_encode($auth_call);
            die();

          } catch (SoapFault $fault) {
            die('Error : ' . $fault->faultstring);
          }
      }

      public function LocationCitiesFetching($CountryCode,$search='')
      {
            $this->Location_SoapClient();
            $params = array(
           'ClientInfo' => array(
                 'AccountCountryCode'		=> 'JO',
                 'AccountEntity'		 	=> 'AMM',
                 // 'AccountNumber'		 	=> '20016',
                 // 'AccountNumber'		 	=> '962781466060',
                 'AccountNumber'		 	=> '20016',
                 // 'AccountPin'		 	=> '331421',
                 'AccountPin'		 	=> '543543',
                 'UserName'			=> 'testingapi@aramex.com',
                 'Password'		 	=> 'R123456789$r',
                 // 'UserName'			=> 'Mandobcom',
                 // 'Password'		 	=> 'Mandobcom@2018',
                 'Version'		 	=> 'v1',
                 'Source' 			=> NULL
               ),
           'Transaction' => array(
                 'Reference1'			=> '001',
                 'Reference2'			=> '002',
                 'Reference3'			=> '003',
                 'Reference4'			=> '004',
                 'Reference5'			=> '005'
               ),
           'CountryCode'			=> $CountryCode,
           'State'				=> NULL,
           'NameStartsWith'		=> $search
         );                                                //dd($params);

           // calling the method and printing results
           try {
             $auth_call = $this->Location_SoapClient->FetchCities($params);  // dd($auth_call);
             return json_encode($auth_call);
             die();
           } catch (SoapFault $fault) {
             die('Error : ' . $fault->faultstring);
           }

          
      }

      public function CalculateRate(Request $request)
      {
            $validator = \Validator::make($request->all(), [
                'Origin_City' => 'required',
                'Origin_CountryCode' => 'required',
                'Destination_City' => 'required',
                'Destination_CountryCode' => 'required',
                'Weight' => 'required',
           ]);
           if ($validator->fails()) { return response()->json([ 'status' => 'notValid' , 'data' => $validator->errors() ]);  }

                $params = array(
        		'ClientInfo' => array(
                  'AccountCountryCode'		=> 'JO',
                  // 'AccountEntity'		 	=> 'AMM',
                  // 'AccountNumber'		 	=> '20016',
                  // 'AccountPin'		 	=> '331421',
                  'UserName'  => 'testingapi@aramex.com',
                  'Password'  => 'R123456789$r',
        					'Version'	  => 'v1.0'
        				),

        		'Transaction' => array(
        						'Reference1'			=> '001'
        					),

        		'OriginAddress' => array(
        						'City'					=> $request->Origin_City,
        						'CountryCode'	  => $request->Origin_CountryCode
        					),

        		'DestinationAddress' => array(
        							'City'					=> $request->Destination_City ,
        							'CountryCode'	  => $request->Destination_CountryCode
        						),
        		'ShipmentDetails' => array(
        						'PaymentType'	      => 'P',
        						'ProductGroup'	    => 'EXP',
        						'ProductType'			  => 'PPX',
        						'ActualWeight' 	    => array('Value' => $request->Weight, 'Unit' => 'KG'),
        						'ChargeableWeight'  => array('Value' => $request->Weight, 'Unit' => 'KG'),
        						'NumberOfPieces'	  => 4
        					)
        	);

        	$soapClient = new \SoapClient(public_path('aramex/aramex-rates-calculator-wsdl.wsdl'), array('trace' => 1));
        	$results = $soapClient->CalculateRate($params);
          return json_encode($results);
        	die();
      }


      public function CreateShipments()
      {
               $soapClient = new \SoapClient(public_path('aramex/shipping-services-api-wsdl.wsdl'));
               // echo '<pre>';
               // print_r($soapClient->__getFunctions());

               $params = array(
                     'Shipments' => array(
                        'Shipment' => array(
                              'Shipper'	=> array(
                                          'Reference1' 	=> 'Ref 111111',
                                          'Reference2' 	=> 'Ref 222222',
                                          'AccountNumber' => '20016',
                                          'PartyAddress'	=> array(
                                             'Line1'					=> 'Mecca St',
                                             'Line2' 				=> '',
                                             'Line3' 				=> '',
                                             'City'					=> 'Amman',
                                             'StateOrProvinceCode'	=> '',
                                             'PostCode'				=> '',
                                             'CountryCode'			=> 'Jo'
                                          ),
                                          'Contact'		=> array(
                                             'Department'			=> '',
                                             'PersonName'			=> 'Michael',
                                             'Title'					=> '',
                                             'CompanyName'			=> 'Aramex',
                                             'PhoneNumber1'			=> '5555555',
                                             'PhoneNumber1Ext'		=> '125',
                                             'PhoneNumber2'			=> '',
                                             'PhoneNumber2Ext'		=> '',
                                             'FaxNumber'				=> '',
                                             'CellPhone'				=> '07777777',
                                             'EmailAddress'			=> 'michael@aramex.com',
                                             'Type'					=> ''
                                          ),
                              ),

                              'Consignee'	=> array(
                                          'Reference1'	=> 'Ref 333333',
                                          'Reference2'	=> 'Ref 444444',
                                          'AccountNumber' => '',
                                          'PartyAddress'	=> array(
                                             'Line1'					=> '15 ABC St',
                                             'Line2'					=> '',
                                             'Line3'					=> '',
                                             'City'					=> 'Dubai',
                                             'StateOrProvinceCode'	=> '',
                                             'PostCode'				=> '',
                                             'CountryCode'			=> 'AE'
                                          ),

                                          'Contact'		=> array(
                                             'Department'			=> '',
                                             'PersonName'			=> 'Mazen',
                                             'Title'					=> '',
                                             'CompanyName'			=> 'Aramex',
                                             'PhoneNumber1'			=> '6666666',
                                             'PhoneNumber1Ext'		=> '155',
                                             'PhoneNumber2'			=> '',
                                             'PhoneNumber2Ext'		=> '',
                                             'FaxNumber'				=> '',
                                             'CellPhone'				=> '',
                                             'EmailAddress'			=> 'mazen@aramex.com',
                                             'Type'					=> ''
                                          ),
                              ),

                              'ThirdParty' => array(
                                          'Reference1' 	=> '',
                                          'Reference2' 	=> '',
                                          'AccountNumber' => '',
                                          'PartyAddress'	=> array(
                                             'Line1'					=> '',
                                             'Line2'					=> '',
                                             'Line3'					=> '',
                                             'City'					=> '',
                                             'StateOrProvinceCode'	=> '',
                                             'PostCode'				=> '',
                                             'CountryCode'			=> ''
                                          ),
                                          'Contact'		=> array(
                                             'Department'			=> '',
                                             'PersonName'			=> '',
                                             'Title'					=> '',
                                             'CompanyName'			=> '',
                                             'PhoneNumber1'			=> '',
                                             'PhoneNumber1Ext'		=> '',
                                             'PhoneNumber2'			=> '',
                                             'PhoneNumber2Ext'		=> '',
                                             'FaxNumber'				=> '',
                                             'CellPhone'				=> '',
                                             'EmailAddress'			=> '',
                                             'Type'					=> ''
                                          ),
                              ),

                              'Reference1' 				=> 'Shpt 0001',
                              'Reference2' 				=> '',
                              'Reference3' 				=> '',
                              'ForeignHAWB'				=> 'ABC 000111',
                              'TransportType'				=> 0,
                              'ShippingDateTime' 			=> time(),
                              'DueDate'					=> time(),
                              'PickupLocation'			=> 'Reception',
                              'PickupGUID'				=> '',
                              'Comments'					=> 'Shpt 0001',
                              'AccountingInstrcutions' 	=> '',
                              'OperationsInstructions'	=> '',

                              'Details' => array(
                                          'Dimensions' => array(
                                             'Length'				=> 10,
                                             'Width'					=> 10,
                                             'Height'				=> 10,
                                             'Unit'					=> 'cm',

                                          ),

                                          'ActualWeight' => array(
                                             'Value'					=> 0.5,
                                             'Unit'					=> 'Kg'
                                          ),

                                          'ProductGroup' 			=> 'EXP',
                                          'ProductType'			=> 'PDX',
                                          'PaymentType'			=> 'P',
                                          'PaymentOptions' 		=> '',
                                          'Services'				=> '',
                                          'NumberOfPieces'		=> 1,
                                          'DescriptionOfGoods' 	=> 'Docs',
                                          'GoodsOriginCountry' 	=> 'Jo',

                                          'CashOnDeliveryAmount' 	=> array(
                                             'Value'					=> 0,
                                             'CurrencyCode'			=> ''
                                          ),

                                          'InsuranceAmount'		=> array(
                                             'Value'					=> 0,
                                             'CurrencyCode'			=> ''
                                          ),

                                          'CollectAmount'			=> array(
                                             'Value'					=> 0,
                                             'CurrencyCode'			=> ''
                                          ),

                                          'CashAdditionalAmount'	=> array(
                                             'Value'					=> 0,
                                             'CurrencyCode'			=> ''
                                          ),

                                          'CashAdditionalAmountDescription' => '',

                                          'CustomsValueAmount' => array(
                                             'Value'					=> 0,
                                             'CurrencyCode'			=> ''
                                          ),

                                          'Items' 				=> array(

                                          )
                              ),
                        ),
                  ),

                     'ClientInfo'  			=> array(
                                                // 'AccountCountryCode'	=> 'JO',
                                                // 'AccountEntity'		 	=> 'AMM',
                                                // 'AccountNumber'		 	=> '20016',
                                                // 'AccountPin'		 	=> '221321',
                                                // 'UserName'			 	=> 'testingapi@aramex.com',
                                                // 'Password'			 	=> 'R123456789$r',
                                                // 'Version'			 	=> '1.0'
                                          'AccountCountryCode'		=> 'JO',
                                          // 'AccountEntity'		 	=> 'AMM',
                                          // 'AccountNumber'		 	=> '20016',
                                          // 'AccountPin'		 	=> '331421',
                                          'UserName'  => 'testingapi@aramex.com',
                                          'Password'  => 'R123456789$r',
                                             'Version'	  => 'v1.0'
                                       ),

                     'Transaction' 			=> array(
                                          'Reference1'			=> '001',
                                          'Reference2'			=> '',
                                          'Reference3'			=> '',
                                          'Reference4'			=> '',
                                          'Reference5'			=> '',
                                       ),
                     'LabelInfo'				=> array(
                                          'ReportID' 				=> 9201,
                                          'ReportType'			=> 'URL',
                     ),
               );

               $params['Shipments']['Shipment']['Details']['Items'][] = array(
                  'PackageType' 	=> 'Box',
                  'Quantity'		=> 1,
                  'Weight'		=> array(
                        'Value'		=> 0.5,
                        'Unit'		=> 'Kg',
                  ),
                  'Comments'		=> 'Docs',
                  'Reference'		=> ''
               );

               // print_r($params);

               try {
                  $auth_call = $soapClient->CreateShipments($params);
                  echo '<pre>';
                  print_r($auth_call);
                  die();
               } catch (SoapFault $fault) {
                  die('Error : ' . $fault->faultstring);
               }
      }

}
