import React, { useState, useEffect } from 'react';
import { Table, Tag, Space, Pagination } from 'antd';

const { Column } = Table;
const axios = require('axios').default;

function ShowUser(props) {
    const data = [
        {
            key: '1',
            úe: 'John',
            lastName: 'Brown',
            age: 32,
            address: 'New York No. 1 Lake Park',
            tags: ['nice', 'developer'],
        }
    ];


    const [users, setUsers] = useState([]);
    const [page, setPage] = useState(1);

    useEffect(() => {
        let group = Number(localStorage.getItem('group_id'));
        axios.post('/api/list-users', {
            'group_id': group,
            'page': page
        })
            .then(function (response) {
                setUsers(() => {
                    let result = response.data.map((item) => {
                        return {
                            'key': item['id'],
                            'email': item['email'],
                            'user_name': item['user_name'],
                            'tags': ['nice', 'developer']
                        }
                    })

                    return result
                }, [])

            })
            .catch(function (error) {
                console.log(error);
                alert('Không thể lấy danh sách user')
            });
    }, [])


    function getNextPage(page) {
        console.log(page);
        return
    }

    return (
        <div>
            <Table
                dataSource={users}
                pagination={{
                    total: 50,
                    current: 1,
                    onChange: function () {
                        let currPage = this.current 
                        getNextPage(currPage+ 1)
                        console.log('Current Page', currPage);
                        ++currPage;
                        console.log('Next Page', currPage);
                    }
                }}
            >
                <Column title="User Name" dataIndex="user_name" key="user_name" />
                <Column title="Email" dataIndex="email" key="age" />
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
                        <Space size="middle">
                            <a>Invite {record.lastName}</a>
                            <a>Delete</a>
                        </Space>
                    )}
                />
            </Table>
        </div>
    );
}

export default ShowUser;
