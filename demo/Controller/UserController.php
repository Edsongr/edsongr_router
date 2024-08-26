<?php 

namespace ESO\Demo;

class UserController
{

    /**
     * @return void
     */
    public function index()
    {

        echo json_encode(
            array(
                'message' => 'Index Response!'
            )
        );
        exit();
    }

    /**
     * @param int|string $id
     * @return void
     */
    public function get($id)
    {

        echo json_encode(
            array(
                'message' => 'Get Response!',
                'id'=> $id,
            )
        );
        exit();
    }

    /**
     * @return void
     */
    public function store()
    {

        echo json_encode(
            array(
                'message' => 'Store Response!',
            )
        );
        exit();
    }

    /**
     * @return void
     */
    public function update()
    {

        echo json_encode(
            array(
                'message' => 'Update Response!',
            )
        );
        exit();
    }

    /**
     * @param int|string $id
     * @return void
     */
    public function delete($id)
    {

        echo json_encode(
            array(
                'message' => 'Delete Response!',
                'id'=> $id,
            )
        );
        exit();
    }

}
