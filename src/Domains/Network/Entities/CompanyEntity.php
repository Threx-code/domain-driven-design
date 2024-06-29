<?php declare(strict_types=1);

namespace Domains\Network\Entities;

use App\Models\Company;

final readonly class CompanyEntity
{
    public function __construct(
        public string $name,
        public string $website,
        public null|string $description,
        public null|string $industry,
        public null|string $size,
        public null|string $founded,
        public null|string $revenue,
        public null|string $location,
        public null|string $logo,
        public null|string $socials,
        public null|string $email,
        public null|string $phone,
        public null|string $address,
        public null|string $city,
        public null|string $state,
        public null|string $zip,
        public null|string $country,
        public null|string $latitude,
        public null|string $longitude
    ){}

    public static function fromEloquent(Company $company): CompanyEntity
    {
        return new CompanyEntity(
            name: $company->name,
            website: $company->website,
            description: $company->description,
            industry: $company->industry,
            size: $company->size,
            founded: $company->founded,
            revenue: $company->revenue,
            location: $company->location,
            logo: $company->logo,
            socials: $company->socials,
            email: $company->email,
            phone: $company->phone,
            address: $company->address,
            city: $company->city,
            state: $company->state,
            zip: $company->zip,
            country: $company->country,
            latitude: $company->latitude,
            longitude: $company->longitude
        );
    }
}
