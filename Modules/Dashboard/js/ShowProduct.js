import React, { useState, useEffect } from 'react';
import { Table, Tag, Space, Pagination, Button } from 'antd';
import { Link } from "react-router-dom";
import { transform_date } from "./func/show_product_func";

const { Column } = Table;
const axios = require('axios').default;

function deleteProduct(id) {
    console.log(id)
}

// Hàm đã export

function ShowProduct(props) {
    const [product, setProduct] = useState([]);
    const [page, setPage] = useState(1);

    useEffect(() => {
        let group = Number(localStorage.getItem('group_id'));
        axios.post('/api/list-product', {
            'group_id': group,
            'page': page
        })
            .then(function (response) {
                console.log(response.data);
                setProduct(() => {
                    let result = response.data.map((item) => {
                        return {
                            'key': item['product_id'],
                            'product_id': item['product_id'],
                            'product_name': item['product_name'],
                            'product_type': item['product_type'],
                            'desc': item['desc'],
                            'url': item['url'],
                            'created_at': transform_date(item['created_at']),
                            'tags': [item['product_type']]
                        }
                    })
                    return result
                }, [])

            })
            .catch(function (error) {
                console.log(error);
                alert('Không thể lấy danh sách Product!')
            });
    }, [])


    function getNextPage(page) {
        console.log(page);
        return
    }

    return (
        <div key='show-list-product'>
            <Table
                dataSource={product}
                pagination={{
                    total: 50,
                    current: 1,
                    key: 'pagination',
                    onChange: function () {
                        let currPage = this.current
                        getNextPage(currPage + 1)
                        console.log('Current Page', currPage);
                        ++currPage;
                        console.log('Next Page', currPage);
                    }
                }}
            >
                <Column title="User Name" dataIndex="product_id" key="product_id" />
                <Column title="product_type" dataIndex="product_type" key="product_type" />
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
                        <Space size="middle" key={record}>
                            <Link to={`/admin/edit-product/`+record.product_id} >
                                <Button>edit</Button>
                            </Link>
                            <Button onClick={()=>deleteProduct(record.product_id)} style={{ color: 'red' }} >Delete</Button>
                        </Space>
                    )}
                />
            </Table>
        </div>
    );
}

export default ShowProduct;
