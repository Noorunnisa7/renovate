<?php

namespace App\Interfaces;


use Illuminate\Http\Request;

interface ExampleRepositoryInterface
{
    /* AGENCY */
    public function getAgency(string $agency);
    public function getAgencyAll(array $filters, array $select);

    /* Clients */
    public function createClient(Request $request, object $stripeResponse);
    public function updateClient(string $client, Request $request, object $stripeResponse, array $columns);
    public function getClients(array $filters, array $select);
    public function getClient(array $filters, $select);
    public function getAllClient($select, $key, $values);
    public function deleteClient(array $filters);
    public function getClientServices(array $filters);
    public function getAllClients(array $filters, array $select);
    public function deleteAllClient(array $filters);

    /* Tax Rates */
    public function createTaxRate(Request $request, object $stripeResponse);
    public function listingTaxRates(string $agencyId);
    
    /* Invoices */
    public function updateOrInsertInvoice(string $stripeId, array $data);
    public function getInvoices($filters, $select = []);
    public function getAllInvoices($select, $key, $values);
    public function getClientServiceInvoices($whereIn, $whereInValues, $select = [], $field, $from, $to);
    public function getAllInvoicesFilters($select, $allFilter = []);
    public function getInvoiceCount(array $filters);
    public function updateInvoice(array $where, array $data);

    /* Agency Revenue */
    public function getAgencyRevenue($filters, $select);
    public function agencyRevenueCreate($fields);

}