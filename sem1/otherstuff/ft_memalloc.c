/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_memalloc.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/05/22 14:16:18 by mmacdona          #+#    #+#             */
/*   Updated: 2017/08/01 16:35:13 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../libft/libft.h"

void	*ft_memalloc(size_t size)
{
	void *temp;

	if (size == 0)
		return (NULL);
	temp = (void *)malloc(sizeof(void) * size);
	if (temp == NULL)
		return (NULL);
	ft_strclr((char*)temp);
	return (temp);
}
