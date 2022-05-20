import React, { useState, useEffect } from 'react';
import { Table, Tag, Space, Pagination, Button } from 'antd';
import { useHistory } from 'react-router-dom';

const { Column } = Table;
const axios = require('axios').default;

function ShowUser(props) {
    const history = useHistory()
    const [users, setUsers] = useState([]);
    const [num_page, setPage] = useState(1);
    let  TOTAL_SIZE = 30
    
    useEffect(() => {
        let group = Number(localStorage.getItem('group_id'));
        let page = 1
        let url = `/api/list-users/${page}`
        axios.get(url)
            .then(function (response) {
                let data = response.data
                let currentPage = data.current_page
                let dataUser = data.data
                TOTAL_SIZE = response.total
                console.log(dataUser)
                setUsers(() => {
                    let result = dataUser.map((item) => {
                        let tag = item.group_id == 1?'admin':'developer'
                        return {
                            'key': item['id'],
                            'id': item['id'],
                            'email': item['email'],
                            'user_name': item['user_name'],
                            'tags': [tag]
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

    const editUserButton = (id)=>{
        let Uri = '/admin/edit-user/'+id
        history.push(Uri)
    }

    function paginationTable() {
        return {
            current: num_page,
            defaultCurrent: 1,
            onChange: function (page, pageSize) {
                let url = `/api/list-users/${page}`
                axios.get(url)
                .then(function (response) {
                    let data = response.data
                    let currentPage = data.current_page
                    let dataUser = data.data
                    setUsers(() => {
                        let result = dataUser.map((item) => {
                            let tag = item.group_id == 1?'admin':'developer'
                            console.log('tag',tag);
                            return {
                                'key': item['id'],
                                'id': item['id'],
                                'email': item['email'],
                                'user_name': item['user_name'],
                                'tags': [tag]
                            }
                        })
    
                        return result
                    }, [])
    
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Không thể lấy danh sách user')
                });
                setPage(page)
            },
            pageSize: 10,
            showLessItems: true,
            total: TOTAL_SIZE 
        }
    }

    function deleteUser(id) {
        let listUser = [...users]
        let listUserNew = listUser.filter((item)=>item.id !== id)
        setUsers(listUserNew)

        axios.delete(`/api/delete-user/${id}`)
        .then(res=>{
            console.log('Xóa thành công:',res)
            alert('Xóa thành công')
        })
        .catch(err=>{
            console.log('Xóa không thành công',err)
            alert('Xóa không thành công')
        })
    }

    return (
        <div>
            <Table
                dataSource={users}
                pagination={paginationTable()}
            >
                <Column title="ID" dataIndex="id" key="id" />
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
                            <Button onClick={()=>editUserButton(record.id)} style={{backgroundColor:'yellow', }}>Edit {record.user_name}</Button>
                            <Button onClick={()=>deleteUser(record.id)} style={{color:'#fff', backgroundColor:'red' }}>Delete</Button>
                        </Space>
                    )}
                />
            </Table>
        </div>
    );
}

export default ShowUser;
