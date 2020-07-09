import gql from "graphql-tag";

export const USERS = gql`
    query Users($first: Int!, $page: Int){
        users(first: $first, page: $page) {
            data {
                id
                username
                roles {
                    id
                }
            }
            paginatorInfo {
                currentPage
                lastPage
            }
        }
    }
`;

export const FIND_USER = gql`
    query User($id: ID!){
        user(id: $id){
            username
            email
            roles {
                id
                name
            }
        }
    }
`;

export const ROLE_NAMES = gql`
    query {
        roles{
            id
            name
        }
    }
`;

export const LOGGED_IN_USER = gql`
    query {
        me {
            id
            username
            email
        }
    }
`;

export const AUTH_CHECK = gql`
    {
        authenticated @client {
            isAuthenticated
        }
    }
`;

export const GET_AUTHENTICATED = gql`
    {
        authenticated @client {
            userId
            accessToken
            isAuthenticated
        }
    }
`;
