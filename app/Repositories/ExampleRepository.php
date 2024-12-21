<?php

namespace App\Repositories;

use App\Models\Agency;
use App\Models\TaxRate;
use App\Models\Invoice;
use App\Models\AgencyRevenue;
use App\Models\ClientService;
use App\Models\AgencyClient;
use Illuminate\Http\Request;
use App\Models\AgencyConnect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\AgencyExpectedRevenue;
use App\Interfaces\AgencyRepositoryInterface;

class AgencyRepository implements AgencyRepositoryInterface
{
    // Agency

    public function getAgency($filters, $select = [])
    {
        return Agency::select($select)
            ->where($filters)
            ->where('customer_id', request()->input('customer_id'))
            ->first();
    }

    public function getAgencyAll($filters, $select = [], $trash = true)
    {
        if($trash){
            $agency = Agency::withTrashed();
        }else{
            $agency = Agency::withoutTrashed();
        }

        if($filters){ $agency = $agency->where($filters); }

        return $agency->select($select)
            ->get();
    }

    public function agencyConnectCreate($fields)
    {
        return AgencyConnect::create($fields);
    }

    public function getAgencyConnect($filters, $select = [])
    {
        return AgencyConnect::select($select)
            ->where($filters)
            ->where('customer_id', request()->input('customer_id'))
            ->first();
    }

    public function createAgency($data)
    {
        return Agency::create($data);
    }

    public function deleteAgencyConnect($filters)
    {
        return AgencyConnect::where($filters)->where('customer_id', request()->input('customer_id'))->delete();
    }

    public function updateAgency($agency, $data)
    {
        return Agency::where('id', $agency)->where('customer_id', request()->input('customer_id'))->update($data);
    }

    public function updateAgencyAll($filters, $data)
    {
        return Agency::withTrashed()->where($filters)->update($data);
    }

    public function deleteAgency($filters)
    {
        return Agency::where($filters)->first()->delete();
    }

    // Clients
    public function createClient(Request $request, object $stripeResponse)
    {
        $request->merge(['stripe_id' => $stripeResponse->id]);

        return AgencyClient::create($request->only(['customer_id', 'name', 'email', 'agency_id', 'stripe_id', 'tax_rate_id', 'country', 'country_code', 'phone', 'logo_image', 'billing_currency']));
    }

    public function updateClient($client, Request $request, object $stripeResponse, array $columns)
    {
        return AgencyClient::where('id', $client)->update($request->only($columns));
    }

    public function updateClientSimple($id, $data, $trash = false)
    {
        if ($trash) {
            $query = AgencyClient::withTrashed()->where('id', $id);
        } else {
            $query = AgencyClient::where('id', $id);
        }
        return $query->update($data);
    }

    public function getClients(array $filters, array $select = [])
    {
        $query = AgencyClient::select($select)
            ->where($filters)
            ->where('customer_id', request()->input('customer_id'));

        if (request()->input('q') != '') {

            $search = htmlspecialchars(strip_tags(request()->input('q')));

            $query = $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });

        } else {
            $query = $query->orderby('id', 'desc');
        }

        $perPage = 5;
        if (request()->has('per_page')) {
            if (request()->query('per_page') != 'all') {
                $perPage = is_numeric(request()->query('per_page')) ? (int)request()->query('per_page') : $perPage;
            } else {
                $perPage = 5000;
            }
        }

        return $query->paginate($perPage);
    }

    public function getClient($filters, $select = [])
    {
        return AgencyClient::select($select)
            ->where($filters)
            ->where('agency_id', request()->input('agency_id'))
            ->first();
    }

    public function getClientSimple($filters, $select = [])
    {
        return AgencyClient::select($select)
            ->where($filters)
            ->first();
    }

    public function getAllClient($select, $key, $values)
    {
        return AgencyClient::select($select)
            ->whereIn($key, $values)
            ->get();
    }

    public function getAgencyClients($select, $orderBy, $order = 'desc', $limit = 10)
    {
        return AgencyClient::select($select)
            ->where('agency_id', request()->input('agency_id'))
            ->orderBy($orderBy, $order)
            ->limit($limit)
            ->get();
    }

    public function getAgencyClientAll($filters, $select = [])
    {
        return AgencyClient::withTrashed()->select($select)
            ->where($filters)
            ->get()
            ;
    }

    public function deleteClient($filters)
    {
        return AgencyClient::where($filters)->first()->delete();
    }

    public function updateAgencyClientAll($filters, $data)
    {
        return AgencyClient::withTrashed()->where($filters)->update($data);
    }

    /* Tax Rates */
    public function createTaxRate(Request $request, object $stripeResponse)
    {
        $request->merge(['stripe_id' => $stripeResponse->id]);

        return TaxRate::create($request->only(['customer_id', 'agency_id', 'stripe_id', 'display_name', 'percentage', 'inclusive', 'country']));
    }

    public function listingTaxRates(string $agencyId)
    {
        return TaxRate::select('id', 'display_name', 'percentage', 'inclusive', 'country')
            ->where('agency_id', $agencyId)
            ->get();
    }

    public function getTaxRate($filters, $select = [])
    {
        return TaxRate::select($select)
            ->where($filters)
            ->where('agency_id', request()->input('agency_id'))
            ->first();
    }

    /* Invoices */
    public function updateOrInsertInvoice($stripeId, $data)
    {
        return Invoice::updateOrInsert(['stripe_id' => $stripeId], $data);
    }

    public function getInvoices($filters, $select = [])
    {
        return Invoice::select($select)
            ->where($filters)
            ->where('agency_id', request()->input('agency_id'))
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getInvoice($filters, $select = [])
    {
        return Invoice::select($select)
            ->where($filters)
            ->where('agency_id', request()->input('agency_id'))
            ->first();
    }

    public function getAllInvoices($select, $key, $values)
    {
        return Invoice::select($select)
            ->whereIn($key, $values)
            ->get();
    }

    public function getClientServices($filters)
    {
        return DB::table('client_services as cs')
            ->join('agency_clients as ac', 'ac.id', '=', 'cs.client_id')
            ->join('services as s', 's.id', '=', 'cs.service_id')
            ->join('service_plans as sp', 'sp.id', '=', 'cs.service_plan_id')
            ->join('service_plan_prices as spp', 'spp.id', '=', 'cs.service_plan_price_id')
            ->select(
                'ac.id as client_id',
                'ac.email',
                'cs.id as id',
                'cs.billing_cycle',
                'cs.created_at',
                's.name',
                's.active as service_status',
                'sp.name as service_plan_name',
                'cs.units',
                'cs.total_amount',
                's.active as service_plan_status',
                'spp.id as service_plan_price_id',
                'spp.currency'
            )
            ->where('ac.agency_id', request()->input('agency_id'))
            ->where('cs.billing_cycle', '!=', 'once')
            ->where($filters)
            ->where('cs.deleted_at', null)
            ->orderBy('cs.id', 'desc')
            ->get();
    }

    public function getClientServicesSimple($filters, $select)
    {
        return ClientService::select($select)
            ->where($filters)
            ->where('agency_id', request()->input('agency_id'))
            ->where('billing_cycle', '!=', 'once')
            ->get();
    }

    public function getClientServiceInvoices($whereIn, $whereInValues, $select = [], $field, $from, $to)
    {
        return Invoice::select($select)
            ->join('client_services as cs', 'invoices.stripe_id', 'cs.stripe_invoice_id')
            ->whereIn($whereIn, $whereInValues)
            ->where($field, '>=', $from)
            ->where($field, '<=', $to)
            ->get();
    }

    // Revenue
    public function agencyRevenueCreate($fields)
    {
        return AgencyRevenue::create($fields);
    }

    public function getAgencyRevenue($filters, $select)
    {
        return \DB::table('report_agency_revenue')
            ->select($select)
            ->where($filters)
            ->first();
    }

    public function updateAgencyRevenue($id, $data)
    {
        return \DB::table('report_agency_revenue')
            ->where('id', $id)
            ->update($data);
    }

    public function getAgencyRevenues($filters, $select, $from = null, $to = null)
    {
        $revenue = \DB::table('report_agency_revenue')
            ->select($select)
            ->where($filters);

        if ($from) {
            $revenue->where('date', '>=', $from);
            $revenue->where('date', '<=', $to);
        }
        return $revenue->get();
    }

    // Expected Revenue
    public function getAgencyExpectedRevenue($filters, $select)
    {
        return \DB::table('report_agency_expected_revenue')
            ->select($select)
            ->where($filters)
            ->first();
    }

    public function updateAgencyExpectedRevenue($id, $data)
    {
        return \DB::table('report_agency_expected_revenue')
            ->where('id', $id)
            ->update($data);
    }

    public function agencyExpectedRevenueCreate($fields)
    {
        return AgencyExpectedRevenue::create($fields);
    }

    public function getAgencyExpectedRevenues($filters, $select, $from = null, $to = null)
    {
        $revenue = \DB::table('report_agency_expected_revenue')
            ->select($select)
            ->where($filters);

        if ($from) {
            $revenue->where('month', '>=', $from);
            $revenue->where('month', '<=', $to);
        }
        return $revenue->orderBy('month', 'desc')->get();
    }

    // Service Revenue
    public function getServiceInvoices($filters, $select = [], $field, $from, $to)
    {
        return ClientService::select($select)
            ->join('invoices', 'invoices.stripe_id', 'client_services.stripe_invoice_id')
            ->where($filters)
            ->where($field, '>=', $from)
            ->where($field, '<=', $to)
            ->get();
    }

    //getAllInvocies
    public function getAllInvoicesFilters($select, $allFilter = []){

        $allInvoices = Invoice::select($select)
            ->join('agency_clients', 'invoices.client_id', '=', 'agency_clients.id');

        $allInvoices = $allInvoices->where('invoices.agency_id', request()->input('agency_id'));

        //sort by invoice status
        if (isset($allFilter['invoice_status'])) {
            $allInvoices = $allInvoices->where('invoices.status', $allFilter['invoice_status']);
        }

        //filter by months
        if (isset($allFilter['start_date']) && isset($allFilter['end_date'])) {
            $allInvoices =  $allInvoices->where('invoices.effective_at', '>=', $allFilter['start_date'])
                ->where('invoices.effective_at', '<=', $allFilter['end_date']);
        }

        //filter by client_name or invoice_number
        if (isset($allFilter['filter'])) {
            $allInvoices = $allInvoices->where(function ($query) use($allFilter) {
                $query->where('agency_clients.name', 'like', '%' . $allFilter['filter'] . '%')
                    ->orWhere('invoices.number', 'like', '%' . $allFilter['filter'] . '%');
            });  
        }

        $allInvoices = $allInvoices->orderBy('invoices.effective_at', 'desc');

        $allInvoices = $allInvoices->paginate(5);

        //for client logo 
        $agencyClient = new AgencyClient();
        $allInvoices->getCollection()->transform(function ($item) use ($agencyClient) {
            if ($item->logo_image_raw){
                $item->logo_image = $agencyClient->getLogoImageAttribute($item->logo_image_raw);
            }
            unset($item->logo_image_raw);
            return $item;
        });

        return $allInvoices;
    }
    
    //get Invoice Count
    public function getInvoiceCount($filters = [])
    {
        return DB::table('invoices')->select(DB::raw('COUNT(*) as total'), 'status')
               ->where($filters)->groupBy(DB::raw('status'))->get();;
    }

    //update invoice
    public function updateInvoice($where, $data = [])
    {
        return Invoice::where($where)->update($data);
    }

    public function getAllClients(array $filters, array $select)
    {
        return AgencyClient::select($select)
        ->where($filters)
        ->get();
    }

    public function deleteAllClient(array $filters)
    {
        return AgencyClient::where($filters)->delete();
    }
}