<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PassportTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBearerTest()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijk2YjE0YWI4MDNlOTYwMmY1M2Q4M2YyZWRhZWZiNzBhMTIzOTBkODkzMmFiZjFkNzNjYWUwZTgxZDVkNjgzNjFjZDY1YmU1MTAzYTdmMDBmIn0.eyJhdWQiOiIxIiwianRpIjoiOTZiMTRhYjgwM2U5NjAyZjUzZDgzZjJlZGFlZmI3MGExMjM5MGQ4OTMyYWJmMWQ3M2NhZTBlODFkNWQ2ODM2MWNkNjViZTUxMDNhN2YwMGYiLCJpYXQiOjE1Mzc0OTE5NjMsIm5iZiI6MTUzNzQ5MTk2MywiZXhwIjoxNTM4Nzg3OTYzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.lTxjd4T3MVWkCr-eFvsxiSlMPVcOPpysp9XvQ2fKFT4J529JoL_ZCDL1UktpBaogjF1Znof8G9lfSJUYzdNUDsUa-ed-vuVI9WQaA-xHFXa6wCpszBx8QOVCvtPce39NPFOUt_XC5pY2vHR89fY-fRxgBH0Qj2lfhFk6oZlrZnO1PoH9gNE-p9qyMpCPBaL_DrxUnYKuTaNrxUeF57g6txu1DI-qpN1dkZBXzKRIZtL4YDEltKidxCKqCxTDe2TeDGn2_93u3I8C1kq-AdrDOlIReP4gks1_7A40zrOfUZ_lPRwz4kVWC_GJeOGm40xADHdIFSIttxGHJyIoj6AQuKqL0SepRkhqkhkEDZxP1THnhsSQJSioVHKu8JqTfxe2i1H5MCWr-W9pmnkOKiScCNqZuXXOGFA2kURnLPdBM1Pwcn9KpQPvlmsIMAGQ1YlyMZRiCqBGjQWNJGmJTfKPwJyHMODTC2juoPlrMzutlDckBM7R9BNLbHDT460MektV4Sc1fKyi8tsu5G7eNh7VinqwBSUUQPQPzIWmwekYdDywhNrN6DEzm4R43PMzFeHSA23sYQkfGML9KAroVd4C8s85ekm39uwpQzDcBJOlohN3PB2WFnsc7aThA3nhHdok6vzkPtz8FeIoB-UOvXyWVQTsEzmpT1wQGt3zFuUKops',
        ])->json('GET', 'api/endpoint');

        $this->assertEquals(200, $response->status());

    }
}
