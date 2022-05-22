import React, { useState, useEffect } from 'react';
import { Table, Tag, Space, Pagination, Button } from 'antd';
import { Link } from "react-router-dom";
import { transform_date } from "./func/show_product_func";

const { Column } = Table;
const axios = require('axios').default;


function ShowProduct() {
    const [product, setProduct] = useState([]);
    const [page, setPage] = useState(1);

    useEffect(() => {
        let group = Number(localStorage.getItem('group_id'));
        axios.get('/api/list-product')
            .then(function (response) {
                console.log('use effect', response.data);
                setProduct(() => {
                    let result = response.data.map((item) => {
                        return {
                            'key': item['id'],
                            'id':item['id'],
                            'product_id': item['product_id'],
                            'product_name': item['products'].product_name,
                            'type': item['type'],
                            'desc': item['desc'],
                            'url': item['url'],
                            'created_at': transform_date(item['created_at']),
                            'tags': [item['type']]
                        }
                    })
                    return result
                })

            })
            .catch(function (error) {
                console.log(error);
                alert('Không thể lấy danh sách Product!')
            });
    }, [])


    function deleteProduct(id) {
        let conf = confirm('Bạn chắc chắn muốn xóa?')
        if (conf) {
            axios.delete(`/api/delete-product/${id}`)
                .then((res) => {
                    alert('Xóa thành công')
                    var newPro = product.filter((item) => (item.id !== id))
                    setProduct(newPro);
                })
                .catch((err) => {
                    console.log(err);
                    alert('Xóa không  thành công!!')
                })
        }
    }

   
    function getNextPage(page) {
        return
    }

    return (
        <div key='show-list-product'>
            <Table
                dataSource={product}
                showPaginationBottom={false}
            >
                <Column title="Product Id" dataIndex="product_id" key={Math.random() + 'product_id'} />
                <Column title="Product Name" dataIndex="product_name" key={'id'+'product_id'} />
                <Column title="desc" dataIndex="desc" key="desc" />
                <Column title="url" dataIndex="url" key="url" />
                <Column title="created_at" dataIndex="created_at" key="created_at" />
                <Column
                    title="Group"
                    dataIndex="tags"
                    key="tags"
                    render={tags => (
                        <>
                            {tags.map(tag => (
                                <Tag color="blue" key={tag}>
                                    {tag}
                                </Tag>
                            ))}
                        </>
                    )}
                />
                <Column
                    title="Action"
                    key="action"
                    render={(text, record) => (
                        <Space size="middle" >
                            <Link to={`/admin/edit-product/` + record.id} >
                                <Button>edit</Button>
                            </Link>
                            <Button onClick={() => deleteProduct(record.id)} style={{ color: 'red' }} >Delete</Button>
                        </Space>
                    )}
                />
            </Table>
        </div>
    );
}

export default ShowProduct;
