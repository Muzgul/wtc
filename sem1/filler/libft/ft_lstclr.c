/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_lstclr.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/12/16 17:26:01 by mmacdona          #+#    #+#             */
/*   Updated: 2017/12/16 17:26:06 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

void	ft_lstclr(t_list **head)
{
	t_list	*current;
	t_list	*prev;

	current = *head;
	while (*head != NULL)
	{
		current = *head;
		prev = current;
		while (current->next != NULL)
		{
			prev = current;
			current = current->next;
		}
		if (current == prev)
			*head = NULL;
		prev->next = NULL;
		if (current->content != NULL)
			ft_memdel(&current->content);
		ft_memdel((void*)&current);
	}
}
