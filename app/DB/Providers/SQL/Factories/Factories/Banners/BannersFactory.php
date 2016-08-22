<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\Banners;

use App\DB\Providers\SQL\Factories\Factories\Banners\Gateways\BannersQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Banner;
use App\DB\Providers\SQL\Models\Block;


class BannersFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Banner();
        $this->tableGateway = new BannersQueryBuilder();
    }
    /**
     * @return array Country::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    /**
     * @param string $id
     * @return Block::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function getBanners($params)
    {
        $collection = collect($this->tableGateway->getBanners($params));
        $bannerType = $collection->groupBy('banner_type');
        $fixedBanners = (isset($bannerType['fix']))?$bannerType['fix']:[];
        $groupedRelevantBanners = (isset($bannerType['relevant']))?$bannerType['relevant']->groupBy('position'):[];
        return [
            'fixBanners' => $fixedBanners,
            'relevantBanners' =>$groupedRelevantBanners
        ];
    }
    public function getBlocksWithSociety()
    {
        return $this->tableGateway->getBlocksWithSociety();
    }

    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    public function store(Banner $banner)
    {
        $banner->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapBlockOnTable($banner));
    }

    public function map($result)
    {
        $banner = clone($this->model);
        $banner->id = $result->id;
        $banner->bannerLink = $result->banner_link;
        $banner->bannerPriority = $result->banner_priority;
        $banner->bannerType = $result->banner_type;
        $banner->image = $result->image;
        $banner->position = $result->position;
        $banner->createdAt = $result->created_at;
        $banner->updatedAt = $result->updated_at;
        return $banner;
    }
    private function mapBlockOnTable(Banner $banner)
    {
        return [
            'position'     => $banner->position,
            'banner_type'=> $banner->bannerType,
            'image'=> $banner->image,
            'banner_priority'=> $banner->bannerPriority,
            'banner_link'=>$banner->bannerLink,
            'created_at'=> $banner->createdAt,
        ];
    }
}