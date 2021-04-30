<?php

namespace Fnatic\Languages\PTBR;


class MessageError
{
  /**
   * Mensagens genéricas
   */

  const NOT_RESULT_FOUND  = "Nenhum resultado encontrado!";
  const CREATE_ERROR = "Error ao adicionar!";
  const UPDATE_ERROR = "Error ao atualizar!";
  const DELETE_ERROR = "Error ao excluir!";
  const PERM_FAIL  = "Você não tem permição!";
  const INVALID_FIELDS = "Verifique os campos e tente novamente!";
  const INVALID_CRED = "Login ou senha inválidos!";


  /**
   * Mensagens User
   */

  const USER_NAME_LENGTH_ERROR = "O nome não pode ser menor que 5 caracteres!";
  const USER_BIRTHDAY_LENGTH_ERROR = "A data de nascimento informada é inválida!";
  const USER_EMAIL_ALREADY_EXIST = "O email informado já está registrado!";
  const USER_EMAIL_INVALID = "O email informado tem um formato inválido!";
  const USER_NOT_FOUND = "Usuario não encontrado!";
  const USER_AGE_ERROR = "Usuario precisa ser de maior!";
  const USER_NOT_DELETE_BALANCE_ERROR = "O usuario não pode ser excluido com balanço diferente de 0 ou com movimentações!";


  /**
   * Mensagens Moviment
   */

  const MOVIMENT_VALUE_INVALID = "O valor da movimentação é inválido";
  const MOVIMENT_TYPE_INVALID = "O tipo da movimentação é inválido";
}
