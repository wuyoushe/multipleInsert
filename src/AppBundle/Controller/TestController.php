<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\DQL;

/**
 * Test controller.
 *
 * @Route("/api/test")
 */
class TestController extends Controller
{
    /**
     * @Route("/new", name="test_new")
     * @Method("POST")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Doctrine\DBAL\DBALException
     */
    public function newAction() {
        $arr = [
            ['live_id' =>111, 'pv_count' => 1111, 'uv_count' => 1000],
            ['live_id' =>222, 'pv_count' => 2222, 'uv_count' => 2000],
            ['live_id' =>333, 'pv_count' => 3333, 'uv_count' => 3000]
        ];
        $conDb = $this->get('database_connection');
        //test 代表表名
        $dbl = new DQL\MultipleInsert($conDb,'test');
        //'live_id', 'pv_count', 'uv_count' 字段名
        $dbl->setColumns(['live_id', 'pv_count', 'uv_count']);
        $dbl->setValues($arr);
        $data = $dbl->execute();

        $results = array('code' => 0,'msg' => '更新成功', 'data' => $data);
        return $this->json($results);

    }
}
