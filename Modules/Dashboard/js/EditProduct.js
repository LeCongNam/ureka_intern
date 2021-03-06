import React, { useState, useEffect } from 'react';
import { Form, Input, Button, Row, Col, Upload, Select } from 'antd';
import { Tabs } from 'antd';
import { UploadOutlined } from '@ant-design/icons';
import { useLocation } from "react-router-dom";
const { Option, OptGroup } = Select;

const { TabPane } = Tabs;
// const axios = require('axios').default
import axios from 'axios';

const layout = {
    labelCol: {
        span: 8,
    },
    wrapperCol: {
        span: 16,
    },
};
/* eslint-disable no-template-curly-in-string */

const validateMessages = {
    required: '${label} is required!',
    types: {
        email: '${label} is not a valid email!',
        number: '${label} is not a valid number!',
    },
    number: {
        range: '${label} must be between ${min} and ${max}',
    },
};
/* eslint-enable no-template-curly-in-string */

(() => {
    document.title = "Edit Product";
})()

function EditProduct(props) {
    var file
    const [form] = Form.useForm();
    const [type, setType] = useState('dev');
    const location = useLocation()
    let productId
    let productType
    let id 

    useEffect(() => {
        let path = location.pathname.split('/')
        productId = path[3]
        id = productId;
        let url = `/api/get-product/${productId}`
        console.log(url);
        axios.get(url)
            .then((res) => {
                console.log(res);
                let data = res.data
                form.setFieldsValue({
                    product_id: data.product_id,
                    product_name: data.products.product_name,
                    type: data.type,
                    desc: data.desc,
                    url: data.url
                })
            })
            .catch((err) => {
                console.log(err);
            })

    })


    const normFile = (e) => {
        file = { ...e.file }
        return e && e.fileList;
    };

    const onFinish = (formValues) => {
        console.log(formValues);
        delete formValues?.upload
        if (typeof file == 'object') {
            let { originFileObj, ...args } = file
            formValues['icon'] = originFileObj || {}
        }
        let formData = new FormData();
        for (const key in formValues) {
            formData.append(key, formValues[key]);
        }
        formData.append('id',id) 
        axios.post(`/api/edit-product/${productId}`, formData)
            .then((res) => {
                console.log(res)
                alert('Th??nh c??ng')
            })
            .catch(err => {
                console.log(err)
                alert('L???i th??m s???n ph???m')
            })
            .then((res) => console.log(res))

    };

    const tabInfo = (activeKey) => {
        setType(activeKey)
    }

    const onFinishFailed = errorInfo => {
        console.log('Failed:', errorInfo);
        alert('Please Enter all Field!!!')
    };



    return (
        <div>
            <Row>
                adfas??s
                <Col offset={4} span={9}>
                    <Form {...layout} name="nest-messages" form={form}
                        onFinish={onFinish} validateMessages={validateMessages}
                        onFinishFailed={onFinishFailed}
                    >
                        <Form.Item
                            disabled
                            name="product_id"
                            label="Product ID"
                            rules={[
                                {
                                    required: true,
                                    message: "Please enter product name"
                                },
                            ]}
                        >
                            <Input disabled />
                        </Form.Item>

                        <Form.Item
                            name="product_name"
                            label="Product Name"
                            rules={[
                                {
                                    required: true,
                                    message: "Please enter product name"
                                },
                            ]}
                        >
                            <Input />
                        </Form.Item>

                        <Form.Item name="desc" label="Product Desc"
                            rules={
                                [
                                    {
                                        required: true,
                                        message: 'Please enter Description Product'
                                    }
                                ]
                            }
                        >
                            <Input.TextArea />
                        </Form.Item>

                        <Form.Item
                            name="url"
                            label="url"
                            rules={[
                                {
                                    required: true,
                                    message: "Please enter product name"
                                },
                            ]}
                        >
                            <Input />
                        </Form.Item>

                        <Form.Item name="type" label="Product Type"
                            rules={
                                [
                                    {
                                        required: true,
                                        message: 'Please enter Description Product'
                                    }
                                ]
                            } >
                            <Select style={{ width: 200 }} >
                                <Option value="dev">Dev</Option>
                                <Option value="prod">Product</Option>
                            </Select>
                        </Form.Item>

                        <Form.Item
                            name="upload"
                            label="Upload"
                            valuePropName="fileList"
                            getValueFromEvent={normFile}
                            extra="upload Imgae"
                        >
                            <Upload name="logo" listType="picture">
                                <Button icon={<UploadOutlined />}>Click to upload</Button>
                            </Upload>
                        </Form.Item>
                        <Form.Item wrapperCol={{ ...layout.wrapperCol, offset: 8 }}>
                            <Button type="primary" htmlType="submit">
                                Submit
                            </Button>
                        </Form.Item>
                    </Form>
                </Col>
            </Row>
        </div>
    );
}

export default EditProduct;
