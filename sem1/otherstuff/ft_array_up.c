/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_array_up.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/05/29 17:37:22 by mmacdona          #+#    #+#             */
/*   Updated: 2017/08/11 14:40:37 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_array_up(char *ap, size_t size, size_t n)
{
	size_t	i;
	char	*new;

	if (ap != NULL && n > 0)
	{
		new = ft_memalloc(size + n);
		i = 0;
		while (i < size)
		{
			new[i] = ap[i];
			i++;
		}
		ft_memdel((void**)&ap);
	}
	else
		return (ap);
	return (new);
}
