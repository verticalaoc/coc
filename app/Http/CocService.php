<?php
namespace App\Http;

use App\Clan;
use App\ClanRanking;
use App\Location;
use App\Member;
use App\Player;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Redirect;
use Mockery\CountValidator\Exception;
use Psy\Exception\RuntimeException;

class CocService
{
    const API_TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImI5MWE2OWVmLWU5ZDgtNGY5Ni1iOTc2LWU2ZmM0NjEyY2VjNiIsImlhdCI6MTQ3MjE2OTU5OSwic3ViIjoiZGV2ZWxvcGVyLzMzYjI0NmNlLTg3MTMtNzllYi1iZTY0LWJlZjk3YWQwMzYwZiIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjIwMi44OS4xMjEuMTYiLCIxLjM0LjIxNS4xMSIsIjEuMzQuMjE1LjE1IiwiNTIuNzYuOTMuMTcyIl0sInR5cGUiOiJjbGllbnQifV19.dO67BRlJUXM4aWDd0RTD9ajRoIREOCocnftThTfMmOabEG57FrgHW2WPHdrS8G0IJ7rXZq771d57sUwnGiGX6g";
    private $client;
    private $headers;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.clashofclans.com/v1/',
            'timeout' => 60.0,
        ]);

        $this->headers = ['Accept' => 'application/json', 'authorization' => 'Bearer ' . self::API_TOKEN];
    }

    /**
     * Get clans - /v1/clans
     *
     * @param array $input input for query.
     *
     * @return array
     */
    public function getClans($input)
    {
        $clans = array();
        $request = new Request('GET', 'https://api.clashofclans.com/v1/clans?' . http_build_query($input), $this->headers);
        $response = $this->client->send($request, ['timeout' => 60.0]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        $clansData = $responseData['items'];

        foreach ($clansData as $clanData) {
            $clanData = $this->flattenData($clanData);
            $clans[] = new Clan($clanData);
        }
        return $clans;
    }

    /**
     * COC API - get clan by clan tag
     *
     * @param $clanTag
     *
     * @return array
     */
    public function getClanByTag($clanTag)
    {
        $request = new Request('GET', 'https://api.clashofclans.com/v1/clans/' . urlencode($clanTag), $this->headers);
        $response = $this->client->send($request, ['timeout' => 60.0]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        $memberList = $responseData['memberList'];
        unset($responseData['memberList']);
        $clan = new Clan($this->flattenData($responseData));
        $members = array();
        foreach ($memberList as $memberData) {
            $member = new Member($this->flattenData($memberData));
            $member->clanId = $clan->id;
            $members[] = $member;
        }
        return array($clan, $members);

    }

    /**
     * Get clan rankings - /v1/locations/{locationId}/rankings/clans
     * The locationId info should be carried in the input array.
     *
     * @param array $input the user input in array.
     *
     * @return array the array of ClanRanking
     */
    public function getClanRankings($input)
    {
        if (!isset($input['locationId']) || empty($input['locationId'])) {
            throw new RuntimeException("locationId is required.");
        }

        $locationId = $input['locationId'];
        unset($input['locationId']);
        $input = $this->removeEmptyInput($input);

        $clanRankings = array();
        $request = new Request(
            'GET',
            'https://api.clashofclans.com/v1/locations/' . $locationId . '/rankings/clans?' . http_build_query($input),
            $this->headers);
        $response = $this->client->send($request, ['timeout' => 60.0]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        foreach ($responseData['items'] as $clanRankingData) {
            $flattenedClanRankingData = $this->flattenData($clanRankingData);
            $clanRankings[] = new ClanRanking($flattenedClanRankingData);
        }
        return $clanRankings;
    }

    /**
     * Get the list of locations - /v1/locations
     *
     * @return Locations
     */
    public function getLocations()
    {
        $request = new Request('GET', 'https://api.clashofclans.com/v1/locations', $this->headers);
        $response = $this->client->send($request, ['timeout' => 60.0]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        $locations = array();
        foreach ($responseData['items'] as $locationData) {
            $locations[] = new Location($locationData);
        }
        return $locations;
    }

    /**
     * Get the list of locations - /v1/locations
     *
     * @return Locations
     */
    public function getPlayerByTag($playerTag)
    {
        $request = new Request('GET', 'https://api.clashofclans.com/v1/players/' . urlencode($playerTag), $this->headers);
        $response = $this->client->send($request, ['timeout' => 60.0]);
//        dd($this->flattenData(json_decode($response->getBody()->getContents(), true)));
        $player = new Player($this->flattenData(json_decode($response->getBody()->getContents(), true)));
        return $player;
    }


    /**
     * Flatten the data.
     *
     * @param $data
     *
     * @return array
     */
    private function flattenData($data)
    {
        do {
            foreach ($data as $key => $value) {
                if (is_array($value) && $this->isAssoc($value)) {
                    $data = array_merge($data, $this->flattenAssocArrayDataWithKey($data, $key));
                    unset($data[$key]);
                } else if (is_array($value) && !$this->isAssoc($value)) {
                    $data = array_merge($data, $this->flattenSeqArrayDataWithKey($data, $key));
                    unset($data[$key]);
                } else {
                    $data[$key] = $value;
                }
            }
        } while (!$this->isFlattened($data));
        return $data;
    }

    /**
     * Flatten associative array data by index.
     *
     * @param $data  the data
     * @param $index the index to flatten
     *
     * @return the flattened data
     */
    private function flattenAssocArrayDataWithKey($data, $index)
    {
        $retData = array();
        if (isset($data[$index])
            && !empty($data[$index])
            && is_array($data[$index])
            && $this->isAssoc($data[$index])
        ) {
            foreach ($data[$index] as $key => $value) {
                $newKey = $index . ucwords($key);
                $retData[$newKey] = $value;
            }
        }
        return $retData;
    }

    /**
     * Flatten sequential array data by index.
     *
     * @param array  $data  the data
     * @param string $index the index
     *
     * @return the flattened data
     * @internal param the $index index to flatten
     *
     */
    private function flattenSeqArrayDataWithKey($data, $index)
    {
        $retData = array();
        if (isset($data[$index])
            && !empty($data[$index])
            && is_array($data[$index])
            && !$this->isAssoc($data[$index])
        ) {
            foreach ($data[$index] as $key => $value) {
                // try to get the name
                $keyName = array_key_exists('name', $data[$index][$key]) ? $data[$index][$key]['name'] : null;
                if ($keyName == null) continue;

                // encoding the name
                $keyName = str_replace(" ", "", $keyName);
                $keyName = str_replace(".", "", $keyName);

                // generate the new name of the key
                $newKey = $index . ucwords(strtolower($keyName));
                $retData[$newKey] = $value;
            }
        }
        return $retData;
    }


    /**
     * Remove the empty element.
     *
     * @param $input
     *
     * @return array
     */
    private function removeEmptyInput($input)
    {
        return array_filter($input,
            function (
                $value
            ) {
                return !empty($value);
            }
        );
    }

    /**
     * Check if all elements are not array.
     *
     * @param $data
     *
     * @return bool
     */
    private function isFlattened($data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check if the given array is associative array.
     * If yes, return true. Otherwise, return false.
     *
     * @param array $arr
     *
     * @return bool
     */
    private function isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }


    /**
     * Get clans - /v1/clans
     *
     * @param $input the input for query.
     *
     * @return array
     */
    public function getAllClans($input)
    {
        // remove the filter for locationId if it equals to 'any'
        if ($input['locationId'] == "any") {
            unset($input['locationId']);
        }
        $input = $this->removeEmptyInput($input);

        $clans = array();
        if ((isset($input['name']) && empty($input['name']) || $input['dev'] = 1)) {
            // optimized search
            $minMembers = $input['minMembers'];
            $maxMembers = $input['maxMembers'];
            for ($members = $maxMembers; $members >= $minMembers; $members--) {
                $input['minMembers'] = $members;
                $input['maxMembers'] = $members;
                $input['limit'] = 1000;
                $queries[] = 'https://api.clashofclans.com/v1/clans?' . http_build_query($input);
                $request = new Request('GET', 'https://api.clashofclans.com/v1/clans?' . http_build_query($input), $this->headers);
                $response = $this->client->send($request, ['timeout' => 60.0]);
                $responseData = json_decode($response->getBody()->getContents(), true);
                $clansData = $responseData['items'];
                $counter[$members] = sizeof($clansData);
                foreach ($clansData as $clanData) {
                    $clanData = $this->flattenData($clanData);
                    $clans[] = new Clan($clanData);
                }
                if (sizeof($clans) >= 1000) {
                    return array_slice($clans, 0, 1000);
                }
            }
        } else {
            $queries[] = 'https://api.clashofclans.com/v1/clans?' . http_build_query($input);
            $request = new Request('GET', 'https://api.clashofclans.com/v1/clans?' . http_build_query($input), $this->headers);
            $response = $this->client->send($request, ['timeout' => 60.0]);
            $responseData = json_decode($response->getBody()->getContents(), true);
            $clansData = $responseData['items'];

            foreach ($clansData as $clanData) {
                $clanData = $this->flattenData($clanData);
                $clans[] = new Clan($clanData);
            }
        }


        return $clans;
    }


}